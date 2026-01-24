# Test đăng nhập
$response = Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/client/dang-nhap" `
    -Method POST `
    -ContentType "application/json" `
    -Body '{"email":"dung.pham@gmail.com","password":"123456"}' `
    -ErrorAction SilentlyContinue

Write-Host "Response status: $($response.StatusCode)"
Write-Host "Response content: $($response.Content)"

try {
    $body = $response.Content | ConvertFrom-Json
    Write-Host "Status: $($body.status)"
    
    if ($body.status) {
        $token = $body.data.token
        Write-Host "Token: $token"
        
        # Test check-token endpoint
        Write-Host "`n=== Testing check-token ==="
        $checkResponse = Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/client/check-token" `
            -Method GET `
            -Headers @{ Authorization = "Bearer $token" } `
            -ErrorAction SilentlyContinue
        
        $checkBody = $checkResponse.Content | ConvertFrom-Json
        Write-Host "Check Response Status: $($checkBody.status)"
        Write-Host "Ho Ten: $($checkBody.ho_ten)"
        Write-Host "Email: $($checkBody.email)"
    }
} catch {
    Write-Host "Error: $_"
}
