<x-mail::message>
    # Booking Confirmation

    Dear {{ $booking['name'] }},

    This is an automatic confirmation of your booking on {{ date('d-m-Y', strtotime($booking['date'])) }} at
    {{ $booking['time'] }}. Below are the details of your booking:

    - Restaurant: Yummy Restaurant
    - Type: {{ $booking['type'] }}
    - Number of people: {{ $booking['people'] }}
    - Total price: Rp. {{ number_format($booking['amount'], 0, ',', '.') }}

    Please wait for our staff to verify your booking. We will send you a verification email once your booking is
    confirmed.

    Thank you for choosing us.

    Best regards,
    Yummy Restaurant
</x-mail::message>
