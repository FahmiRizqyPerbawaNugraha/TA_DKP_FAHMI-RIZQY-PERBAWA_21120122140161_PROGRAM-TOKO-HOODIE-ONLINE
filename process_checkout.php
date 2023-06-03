<!DOCTYPE html>
<html>
<head>
    <title>Process Checkout</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Nota Pembayaran</h2>

        <?php
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $payment = $_POST['payment'];

            $cart = $_SESSION['cart'];
            $total = 0;

            echo '<div class="confirmation">';
            echo '<h3>Terima Kasih, ' . $name . ', telah memilih metode pembayaran dan mengonfirmasi pembayaran Anda.</h3>';
            echo '<p>Rincian Pembelian:</p>';
            echo '<table>';
            echo '<tr>';
            echo '<th>Nama</th>';
            echo '<th>Harga</th>';
            echo '</tr>';
            foreach ($cart as $item) {
                echo '<tr>';
                echo '<td>' . $item['name'] . '</td>';
                echo '<td>Rp ' . number_format($item['price'], 0, ',', '.') . '</td>';
                echo '</tr>';
                $total += $item['price'];
            }
    
            echo '<tr>';
            echo '<td class="total">Total</td>';
            echo '<td class="total">Rp ' . number_format($total, 0, ',', '.') . '</td>';
            echo '</tr>';
            echo '</table>';
    
            echo '<p>Alamat Pengiriman: ' . $address . '</p>';
            echo '<p>No. HP: ' . $phone . '</p>';
            echo '<p>Metode Pembayaran: ' . $payment . '</p>';
    
            echo '<p>Pembayaran Anda telah berhasil dikonfirmasi. Terima kasih atas pembelian Anda!</p>';
    
            echo '<form method="post" action="index.php">';
            echo '<button type="submit">Kembali ke Beranda</button>';
            echo '</form>';
    
            echo '</div>';
    
            $_SESSION['cart'] = array();
        } else {
            echo '<p>Permintaan tidak valid.</p>';
        }
        ?>
    </div>
    </body>
</html>