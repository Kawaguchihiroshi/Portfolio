<?php
require './vendor/autoload.php';

// ご自身のAPIキーを入力
$secretKey = 'sk_test_51ID2xXCiMllTkfaUy8s5ctueGuzmPUGoAvAcEfqWpSeAT5hE15tTi6IXNw45kwvC3h5tfEnivlUkMmm96LdZAj7E003gUXfcyG';

$stripe = new \Stripe\StripeClient($secretKey);

$session = $stripe->checkout->sessions->retrieve($_GET['session_id'], []);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>完了ページ</title>
<script src="https://js.stripe.com/v3/"></script>
</head>

<body>
<?php
if ($session->payment_status === 'paid') {
    echo '<p>支払いが完了しました</p>';
}
if ($session->payment_status === 'unpaid') {
    echo '<p>支払いが完了していません</p>';
}
?>
</body>
</html>