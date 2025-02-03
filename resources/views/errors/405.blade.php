@extends('errors::minimal')

@section('title', __('Method Not Allowed'))
@section('code', '405')
@section('message', __('Method Not Allowed'))
@section('body', __('This page is experiencing an error, please refresh the page.'))