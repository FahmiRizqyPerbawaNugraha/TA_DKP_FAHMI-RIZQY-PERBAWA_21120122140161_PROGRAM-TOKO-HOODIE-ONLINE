<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>

        <?php
        session_start();

        if (isset($_POST['checkout'])) {
            $cart = $_SESSION['cart'];
            $total = 0;

            echo '<div class="checkout">';
            echo '<h3>Rincian Pembelian</h3>';
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

            echo '<form method="post" action="process_checkout.php">';
            echo '<label for="name">Nama:</label>';
            echo '<input type="text" id="name" name="name" required>';
            echo '<label for="address">Alamat:</label>';
            echo '<input type="text" id="address" name="address" required>';
            echo '<label for="phone">No. HP:</label>';
            echo '<input type="text" id="phone" name="phone" required>';
            echo '<label for="payment">Metode Pembayaran:</label>';
            echo '<select id="payment" name="payment" required>';
            echo '<option value="">Pilih metode pembayaran</option>';
            echo '<option value="COD">COD</option>';
            echo '</select>';
            echo '<button type="submit">Konfirmasi Pembayaran</button>';
            echo '</form>';

            echo '<form method="post" action="index.php">';
            echo '<button type="submit">Kembali</button>';
            echo '</form>';

            echo '</div>';
        } else {
            echo '<p>Tidak ada rincian pembelian yang tersedia.</p>';
        }
        ?>
    </div>
</body>
</html>
