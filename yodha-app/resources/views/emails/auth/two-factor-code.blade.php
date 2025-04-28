<!DOCTYPE html>
<html>
<head>
    <title>Two-Factor Authentication Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h2 style="color: #2563eb; text-align: center; margin-bottom: 20px;">FloodRescue Authentication</h2>
        
        <p>Hello {{ $user->name }},</p>
        
        <p>Your two-factor authentication code is:</p>
        
        <div style="background: #f3f4f6; padding: 15px; border-radius: 5px; text-align: center; margin: 20px 0;">
            <h1 style="margin: 0; color: #1e40af; letter-spacing: 5px;">{{ $user->two_factor_code }}</h1>
        </div>
        
        <p>This code will expire in 10 minutes.</p>
        
        <p>If you didn't request this code, please ignore this email.</p>
        
        <p style="margin-top: 30px; text-align: center; color: #6b7280; font-size: 14px;">
            &copy; {{ date('Y') }} FloodRescue. Bersama Lawan Banjir!
        </p>
    </div>
</body>
</html>