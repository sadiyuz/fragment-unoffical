# fragment-unoffical
Fragment Unoffical API example code using PHP

# Example of usage
- Get JWT token
```
$response = Fragment::auth('api_key', 'phonenumber', ['nuble', ...]);
$token = $response['token'] ?? null; // You can save to file
```

- Wallet balance
```
$response = Fragment::walletBalance($jwt_token);
$balance = $response['token'] ?? 0;
```

- Buy stars
```
$response = Fragment::buyStars('sadiyuz', 50, $jwt_token);
$success = $response['success'] ?? false;
```
