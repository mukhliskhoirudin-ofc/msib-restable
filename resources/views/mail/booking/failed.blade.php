<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Failed</title>
    <style type="text/css">
        /* Base styles */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8fafc;
            color: #333333;
            line-height: 1.6;
        }

        /* Modern color palette */
        :root {
            --error: #EF4444;
            --error-dark: #DC2626;
            --secondary: #3B82F6;
            --dark: #1F2937;
            --light: #F9FAFB;
            --border: #E5E7EB;
        }
    </style>
</head>

<body
    style="margin:0; padding:0; font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color:#f8fafc;">

    <!-- Email container -->
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:0 auto;">
                    <!-- Logo/Header -->
                    <tr>
                        <td style="padding:0 0 20px; text-align:center;">
                            <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Yummy Restaurant"
                                style="height:50px;">
                        </td>
                    </tr>

                    <!-- Main card -->
                    <tr>
                        <td
                            style="background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
                            <!-- Header banner -->
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td
                                        style="background-color:#EF4444; padding:24px; text-align:center; color:#ffffff;">
                                        <h1 style="margin:0; font-size:20px; font-weight:600;">Reservation Failed</h1>
                                        <p style="margin:8px 0 0; font-size:14px; opacity:0.9;">We couldn't process your
                                            reservation</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Content -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="padding:32px;">
                                <tr>
                                    <td>
                                        <h2 style="margin:0 0 16px; color:#EF4444; font-size:18px; font-weight:600;">
                                            Status: Failed</h2>

                                        <p style="margin:0 0 16px;">Dear <strong
                                                style="color:#1F2937;">{{ $booking['name'] }}</strong>,</p>

                                        <p style="margin:0 0 24px;">
                                            We regret to inform you that your booking request for
                                            <strong>{{ date('d F Y', strtotime($booking['date'])) }}</strong>
                                            at <strong>{{ date('H:i', strtotime($booking['time'])) }}</strong> could not
                                            be completed.
                                        </p>

                                        <!-- Reason for failure -->
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="margin:0 0 24px; background-color:#FEE2E2; border-radius:8px; border:1px solid #FECACA; color:#B91C1C; padding:16px;">
                                            <tr>
                                                <td>
                                                    <strong>Reason: {{ $booking['reason'] }}</strong>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Booking details card -->
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="margin:0 0 24px; background-color:#F9FAFB; border-radius:8px; border:1px solid #E5E7EB;">
                                            <tr>
                                                <td style="padding:16px; border-bottom:1px solid #E5E7EB;">
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="40%" style="color:#6B7280; font-size:14px;">
                                                                Restaurant</td>
                                                            <td style="font-weight:500;">Yummy Restaurant</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:16px; border-bottom:1px solid #E5E7EB;">
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="40%" style="color:#6B7280; font-size:14px;">
                                                                Reservation Type</td>
                                                            <td style="font-weight:500;">{{ $booking['type'] }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:16px; border-bottom:1px solid #E5E7EB;">
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="40%" style="color:#6B7280; font-size:14px;">
                                                                Number of Guests</td>
                                                            <td style="font-weight:500;">{{ $booking['people'] }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:16px;">
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="40%" style="color:#6B7280; font-size:14px;">
                                                                Total Amount</td>
                                                            <td style="font-weight:500; color:#10B981;">Rp.
                                                                {{ number_format($booking['amount'], 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- <!-- CTA Buttons -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 32px;">
                                            <tr>
                                                <td align="center" style="padding-bottom:16px;">
                                                    <a href="{{ route('/') }}"
                                                        style="display:inline-block; padding:12px 24px; background-color:#3B82F6; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:500; font-size:15px; box-shadow:0 2px 4px rgba(59, 130, 246, 0.2);">
                                                        Try Again
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <a href="{{ route('contact') }}"
                                                        style="display:inline-block; padding:12px 24px; background-color:#ffffff; color:#3B82F6; text-decoration:none; border-radius:6px; font-weight:500; font-size:15px; border:1px solid #3B82F6;">
                                                        Contact Support
                                                    </a>
                                                </td>
                                            </tr>
                                        </table> --}}

                                        <p style="margin:0 0 16px;">If you believe this is an error, please contact our
                                            support team immediately.</p>

                                        <p style="margin:0;">We apologize for any inconvenience and hope to serve you
                                            soon.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:32px 0 0; text-align:center;">
                            <p style="margin:0 0 8px; font-size:12px; color:#6B7280;">
                                &copy; {{ date('Y') }} Yummy Restaurant. All rights reserved.
                            </p>
                            <p style="margin:0; font-size:12px; color:#6B7280;">
                                Jl. Culinary Delight No.88, Jakarta •
                                <a href="mailto:support@yummy.com"
                                    style="color:#3B82F6; text-decoration:none;">support@yummy.com</a>
                            </p>

                            <!-- Social links -->
                            <table cellpadding="0" cellspacing="0" style="margin:16px auto 0;">
                                <tr>
                                    <td style="padding:0 8px;">
                                        <a href="#" style="display:inline-block;">
                                            <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png"
                                                alt="Instagram" width="24"
                                                style="width:24px; height:24px; opacity:0.6;">
                                        </a>
                                    </td>
                                    <td style="padding:0 8px;">
                                        <a href="#" style="display:inline-block;">
                                            <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png"
                                                alt="Facebook" width="24"
                                                style="width:24px; height:24px; opacity:0.6;">
                                        </a>
                                    </td>
                                    <td style="padding:0 8px;">
                                        <a href="#" style="display:inline-block;">
                                            <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png"
                                                alt="Twitter" width="24"
                                                style="width:24px; height:24px; opacity:0.6;">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
