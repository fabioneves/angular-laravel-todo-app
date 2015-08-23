angular.module('todoApp', [])
    .controller('TodoListController', function ($http, config) {

        var todoList = this;

        // Get todos.
        $http.get(config.backend).success(function (response) {
            todoList.todos = response;
            console.log(response);
        });

        todoList.updateTodo = function() {
            // API Request to change the todo status in the DB.
            //$http.post('/api/todo', {text: todoList.todoText, done: false})
            //    .success(function (response) {
            //        // Update UI.
            //        todoList.todos.push({text: todoList.todoText, done: false});
            //        todoList.todoText = '';
            //    });
        }

        // Add todo.
        todoList.addTodo = function () {
            // API Request to add the todo to the database.
            $http.post(config.backend, {text: todoList.todoText, done: false})
                .success(function (response) {
                    // Update UI.
                    todoList.todos.push({text: todoList.todoText, done: false});
                    todoList.todoText = '';
                });
        };

        todoList.remaining = function () {
            var count = 0;
            angular.forEach(todoList.todos, function (todo) {
                count += todo.done ? 0 : 1;
            });
            return count;
        };

    });