<?php
require_once __DIR__ . '/../config.php';

function sendEmail(string $to, string $subject, string $body): bool {
    $headers = [
        'From: ' . MAIL_FROM_NAME . ' <' . MAIL_FROM . '>',
        'Reply-To: ' . MAIL_FROM,
        'Content-Type: text/html; charset=UTF-8',
        'X-Mailer: BT-ParkShare',
    ];

    $htmlBody = '<!DOCTYPE html><html><body style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;">';
    $htmlBody .= '<div style="background:#1a5276;color:white;padding:20px;text-align:center;">';
    $htmlBody .= '<h2>' . SITE_NAME . '</h2></div>';
    $htmlBody .= '<div style="padding:20px;border:1px solid #ddd;">' . $body . '</div>';
    $htmlBody .= '<div style="padding:10px;text-align:center;color:#888;font-size:12px;">';
    $htmlBody .= 'Bellevue Towers Condominium &mdash; Parking Spot Sharing</div>';
    $htmlBody .= '</body></html>';

    return mail($to, $subject, $htmlBody, implode("\r\n", $headers));
}

function sendBookingConfirmationToDonor(array $donor, array $borrower, array $booking, string $parkingSpot): void {
    $subject = 'Your parking spot #' . $parkingSpot . ' has been reserved';
    $body = '<p>Hello ' . htmlspecialchars($donor['name']) . ',</p>';
    $body .= '<p><strong>' . htmlspecialchars($borrower['name']) . '</strong> (Unit ' . htmlspecialchars($borrower['unit_number']) . ') ';
    $body .= 'has reserved your parking spot <strong>#' . htmlspecialchars($parkingSpot) . '</strong>.</p>';
    $body .= '<p><strong>From:</strong> ' . date('M j, Y g:i A', strtotime($booking['start_datetime'])) . '<br>';
    $body .= '<strong>Until:</strong> ' . date('M j, Y g:i A', strtotime($booking['end_datetime'])) . '</p>';
    $body .= '<p>Contact: ' . htmlspecialchars($borrower['phone']) . ' / ' . htmlspecialchars($borrower['email']) . '</p>';
    sendEmail($donor['email'], $subject, $body);
}

function sendBookingConfirmationToBorrower(array $borrower, array $donor, array $booking, string $parkingSpot): void {
    $subject = 'Parking spot #' . $parkingSpot . ' confirmed';
    $body = '<p>Hello ' . htmlspecialchars($borrower['name']) . ',</p>';
    $body .= '<p>You have reserved parking spot <strong>#' . htmlspecialchars($parkingSpot) . '</strong> ';
    $body .= 'from <strong>' . htmlspecialchars($donor['name']) . '</strong> (Unit ' . htmlspecialchars($donor['unit_number']) . ').</p>';
    $body .= '<p><strong>From:</strong> ' . date('M j, Y g:i A', strtotime($booking['start_datetime'])) . '<br>';
    $body .= '<strong>Until:</strong> ' . date('M j, Y g:i A', strtotime($booking['end_datetime'])) . '</p>';
    $body .= '<p>Contact: ' . htmlspecialchars($donor['phone']) . ' / ' . htmlspecialchars($donor['email']) . '</p>';
    sendEmail($borrower['email'], $subject, $body);
}

function sendExpiryNotice(array $borrower, array $booking, string $parkingSpot): void {
    $subject = 'Your parking reservation for spot #' . $parkingSpot . ' has expired';
    $body = '<p>Hello ' . htmlspecialchars($borrower['name']) . ',</p>';
    $body .= '<p>Your reservation for parking spot <strong>#' . htmlspecialchars($parkingSpot) . '</strong> has expired.</p>';
    $body .= '<p>The reservation ended at <strong>' . date('M j, Y g:i A', strtotime($booking['end_datetime'])) . '</strong>.</p>';
    $body .= '<p>Please ensure the spot is now available for its owner. Thank you!</p>';
    sendEmail($borrower['email'], $subject, $body);
}

function sendAccountApprovedNotice(array $user): void {
    $subject = 'Your ' . SITE_NAME . ' account has been approved';
    $body = '<p>Hello ' . htmlspecialchars($user['name']) . ',</p>';
    $body .= '<p>Your account has been approved! You can now <a href="' . SITE_URL . '/login.php">log in</a> ';
    $body .= 'to share or find parking spots.</p>';
    sendEmail($user['email'], $subject, $body);
}

function sendNewRegistrationNotice(array $user): void {
    $subject = 'New registration pending approval: ' . $user['name'];
    $body = '<p>A new user has registered and is awaiting approval:</p>';
    $body .= '<ul>';
    $body .= '<li><strong>Name:</strong> ' . htmlspecialchars($user['name']) . '</li>';
    $body .= '<li><strong>Email:</strong> ' . htmlspecialchars($user['email']) . '</li>';
    $body .= '<li><strong>Unit:</strong> ' . htmlspecialchars($user['unit_number']) . '</li>';
    $body .= '<li><strong>Parking Spot:</strong> ' . htmlspecialchars($user['parking_spot']) . '</li>';
    $body .= '</ul>';
    $body .= '<p><a href="' . SITE_URL . '/admin/users.php">Review pending accounts</a></p>';
    sendEmail(ADMIN_EMAIL, $subject, $body);
}
