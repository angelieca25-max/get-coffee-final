<?php

$conn = mysqli_connect("localhost", "root", "", "db_getcoffee"); 

if (isset($_POST['simpan'])) {
    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga     = $_POST['harga'];
    
    $id_kategori = 1; 
    $id_admin    = 1; 

    $fileName    = $_FILES['gambar']['name'];
    $fileTmpName = $_FILES['gambar']['tmp_name'];
    $fileSize    = $_FILES['gambar']['size'];
    $fileError   = $_FILES['gambar']['error'];
    
    $targetDir   = "../uploads/"; 
    $fileExt     = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExt  = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileExt, $allowedExt)) {
        if ($fileError === 0) {
            if ($fileSize < 2097152) { 
                
                $newFileName = uniqid('', true) . "." . $fileExt;
                $fileDestination = $targetDir . $newFileName;
                

                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    
                    $sql = "INSERT INTO menu (id_kategori, nama_menu, harga, deskripsi, gambar, id_admin) 
                            VALUES ('$id_kategori', '$nama_menu', '$harga', '$deskripsi', '$newFileName', '$id_admin')";
                    
                    $query = mysqli_query($conn, $sql);

                    if ($query) {
                        echo "<script>
                                alert('Menu baru dan gambar berhasil disimpan!');
                                window.location.href='menu.php';
                              </script>";
                    } else {
                        echo "Gagal menyimpan ke database: " . mysqli_error($conn);
                    }

                } else {
                    echo "Gagal memindahkan file gambar ke server folder uploads.";
                }
            } else {
                echo "Ukuran gambar terlalu besar! Maksimal 2MB.";
            }
        } else {
            echo "Terjadi error saat sistem mengunggah gambar.";
        }
    } else {
        echo "Format file salah! Hanya diperbolehkan JPG, JPEG, PNG, atau GIF.";
    }

} else {
    header("Location: menu.php");
    exit;
}
?>