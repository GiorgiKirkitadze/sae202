<?php

function index() {
    header('Location: /gestion');
    exit();
}

function login() {
    header('Location: /gestion/login');
    exit();
}

function dashboard() {
    header('Location: /gestion/dashboard');
    exit();
}

function logout() {
    header('Location: /gestion/logout');
    exit();
}
