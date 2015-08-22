<!doctype html>
<html ng-app="todoApp">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Angular Laravel todo app</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="{{ asset('js/todo.js') }}"></script>
</head>
<body>

<h2>Todo</h2>

<div ng-controller="TodoListController as todoList">
    <span>@{{todoList.remaining()}} of @{{todoList.todos.length}} remaining</span>
    [ <a href="" ng-click="todoList.archive()">archive</a> ]
    <ul class="unstyled">
        <li ng-repeat="todo in todoList.todos">
            <input type="checkbox" ng-model="todo.done">
            <span class="done-@{{todo.done}}">@{{todo.text}}</span>
        </li>
    </ul>
    <form ng-submit="todoList.addTodo()">
        <input type="text" ng-model="todoList.todoText" size="30" placeholder="add new todo here">
        <input class="btn btn-primary" type="submit" value="add">
    </form>
</div>
</body>
</html>