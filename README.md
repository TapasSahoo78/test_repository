Your modified `redirectTo` method in the `Authenticate` middleware seems correct for your requirements. It checks if the request is targeting an API route, and if so, it returns a JSON response indicating that the user is unauthenticated. Otherwise, it redirects to the login route for web pages.

Here's the modified method:

```php
protected function redirectTo(Request $request): ?string
{
    if ($request->is('api/*')) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    } else {
        return redirect()->route('login');
    }
}
```

This code checks if the request is targeting an API route using `$request->is('api/*')`. If it is, it returns a JSON response with a 401 status code. If the request is not targeting an API route, it redirects to the login route for web pages.

This setup ensures that API calls receive a JSON response indicating unauthenticated access, while non-API calls are redirected to the login page. It aligns with your requirement of providing different responses based on the type of request.