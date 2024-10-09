<?php

function backWithError($message)
{
    $notification = [
        'message' => $message,
        'alert-type' => 'error'
    ];
    return back()->with($notification);
}

function backWithSuccess($message)
{
    $notification = [
        'message' => $message,
        'alert-type' => 'success'
    ];
    return back()->with($notification);
}

function backWithWarning($message)
{
    $notification = [
        'message' => $message,
        'alert-type' => 'warning'
    ];
    return back()->with($notification);
}

function redirectBackWithWarning($message, $route)
{
    $notification = [
        'message' => $message,
        'alert-type' => 'warning'
    ];
    return redirect()->route($route)->with($notification);
}

function redirectBackWithError($message, $route)
{
    $notification = [
        'message' => $message,
        'alert-type' => 'error'
    ];
    return redirect()->route($route)->with($notification);
}

function redirectBackWithSuccess($message, $route)
{
    $notification = [
        'message' => $message,
        'alert-type' => 'success'
    ];
    return redirect()->route($route)->with($notification);
}
