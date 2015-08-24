angular.module('todoApp', [])
    .controller('TodoListController', function ($scope, $http, config) {

        var todoList = this;

        // Get todos.
        $http.get(config.backend).success(function (response) {
            todoList.todos = response;
            console.log(todoList.todos);
        });

        // Add todo.
        todoList.addTodo = function () {
            if (todoList.todoText) {
                // API Request to add the todo to the database.
                $http.post(config.backend, {text: todoList.todoText, done: false})
                    .success(function (response) {
                        // Update DOM.
                        todoList.todos.push({id: response.id, text: todoList.todoText, done: false});
                        todoList.todoText = '';
                    });
            }
        };

        // Update todo.
        todoList.updateTodo = function (todo) {
            // API Request to update the todo in the database.
            $http.post(config.backend + todo.id, {'text': todo.text, 'done': todo.done, '_method': 'put'});
        }

        // Delete todo.
        todoList.deleteTodo = function (todo) {
            index = todoList.todos.indexOf(todo);
            if (index != -1) {
                // Delete the todo from the database.
                $http.delete(config.backend + todo.id).success(function () {
                    // Update DOM.
                    todoList.todos.splice(index, 1);
                });
            }
        }

        // Set todo to done.
        todoList.setTodoDone = function (todo) {
            todo.done = (todo.done) ? false : true;
            todoList.updateTodo(todo);
        }

        // Clear completed todos.
        todoList.clearCompleted = function () {
            // Update DB through API.
            $http.post(config.backend + 'deldone').success(function () {
                // Update DOM.
                todoList.todos = todoList.todos.filter(function (todo) {
                    return !todo.done;
                });
            });
        }

        // Remaining todos.
        todoList.remaining = function () {
            var count = 0;
            angular.forEach(todoList.todos, function (todo) {
                count += todo.done ? 0 : 1;
            });
            return count;
        };

    })

    /*
     This directive allows us to pass a function in on an enter key to do what we want.
     */
    .directive('ngEnter', function () {
        return function (scope, element, attrs) {
            element.bind("keydown keypress", function (event) {
                if (event.which === 13) {
                    scope.$apply(function () {
                        scope.$eval(attrs.ngEnter);
                    });

                    event.preventDefault();
                }
            });
        };
    });

