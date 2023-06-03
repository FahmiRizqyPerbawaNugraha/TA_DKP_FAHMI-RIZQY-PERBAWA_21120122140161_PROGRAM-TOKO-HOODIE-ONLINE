<!DOCTYPE html>
<html>
<head>
    <title>Toko Hoodie Online</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Toko Hoodie Online</h2>
    <?php
        class HoodieShop {
            private $cart;
            private $hoodies;
            
            public function __construct() {
                session_start();
                
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array();
                }
                
                $this->cart = &$_SESSION['cart'];
                
                $this->hoodies = array(
                    array('name' => 'Hoodie Hitam', 'price' => 120000, 'image' => 'hoodie1.1.jpg', 'sizes' => array('S', 'M', 'L')),
                    array('name' => 'Hoodie Putih', 'price' => 120000, 'image' => 'hoodie2.2.jpg', 'sizes' => array('S', 'M', 'L')),
                    array('name' => 'Hoodie Merah', 'price' => 135000, 'image' => 'hoodie3.3.jpg', 'sizes' => array('S', 'M', 'L')),
                    array('name' => 'Hoodie Biru', 'price' => 135000, 'image' => 'hoodie4.4.jpg', 'sizes' => array('S', 'M', 'L')),
                    array('name' => 'Hoodie Pink', 'price' => 155000, 'image' => 'hoodie5.5.jpg', 'sizes' => array('S', 'M', 'L'))
                );
            }
            
            public function processPurchase() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
                    if (isset($_POST['buy'])) {
                        $index = $_POST['buy'];
                        if (isset($this->hoodies[$index])) {
                            $hoodie = $this->hoodies[$index];
                            $size = $_POST['size'][$index];
                            $hoodie['selected_size'] = $size;
                            array_push($this->cart, $hoodie);
                            echo 'Hoodie ' . $hoodie['name'] . ' dengan ukuran ' . $size . ' telah ditambahkan ke keranjang belanja.</p>';
                        }
                    } elseif (isset($_POST['clear'])) {
                        $this->cart = array();
                        echo 'Keranjang belanja telah dihapus.</p>';
                    }
                }
            }
            
            public function displayHoodies() {
                foreach ($this->hoodies as $index => $hoodie) {
                    echo '<div class="product">';
                    echo '<img src="' . $hoodie['image'] . '" alt="' . $hoodie['name'] . '">';
                    echo '<p><strong>' . $hoodie['name'] . '</strong></p>';
                    echo '<p>Harga: Rp ' . number_format($hoodie['price'], 0, ',', '.') . '</p>';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="buy" value="' . $index . '">';
                    echo '<select name="size[' . $index . ']">';
                    echo '<option value="">Pilih ukuran</option>';
                    foreach ($hoodie['sizes'] as $size) {
                        echo '<option value="' . $size . '">' . $size . '</option>';
                    }
                    echo '</select>';
                    echo '<button type="submit">Beli</button>';
                    echo '</form>';
                    echo '</div>';
                }
            }
            
            public function displayCart() {
                if (!empty($this->cart)) {
                    echo '<div class="cart">';
                    echo '<h3>Keranjang Belanja</h3>';
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Nama</th>';
                    echo '<th>Ukuran</th>';
                    echo '<th>Harga</th>';
                    echo '</tr>';
                    $total = 0;
                    foreach ($this->cart as $item) {
                        echo '<tr>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . $item['selected_size'] . '</td>';
                        echo '<td>Rp ' . number_format($item['price'], 0, ',', '.') . '</td>';
                        echo '</tr>';
                        $total += $item['price'];
                    }
                    echo '<tr>';
                    echo '<td class="total">Total</td>';
                    echo '<td></td>';
                    echo '<td class="total">Rp ' . number_format($total, 0, ',', '.') . '</td>';
                    echo '</tr>';
                    echo '</table>';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="clear" value="1">';
                    echo '<button type="submit">Hapus Keranjang</button>';
                    echo '</form>';
                    echo '<form method="post" action="checkout.php">';
                    echo '<input type="hidden" name="checkout" value="1">';
                    echo '<button type="submit">Checkout</button>';
                    echo '</form>';
                    echo '</div>';
                }
            }
        }

        $shop = new HoodieShop();
        $shop->processPurchase();
        $shop->displayHoodies();
        $shop->displayCart();
    ?>
</body>
</html>
