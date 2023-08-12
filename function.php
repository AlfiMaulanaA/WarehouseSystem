<?php
    session_start();
    //Database Connection

$conn = mysqli_connect('localhost:3307', 'root', '', 'warehousesystem');

    //Add New Material List
    if(isset($_POST['addnewbarang'])){ //Button Name With Condition
        $namabarang = $_POST['namabarang']; //devine name $namabrang from database table (namabarang)
        $deskripsi = $_POST['deskripsi'];
        $stock = $_POST['stock'];
        $hargasatuan = $_POST['harga'];



        //Fill in table with var $addtotable, call function mysqli_query call connection database, Insert Into name table and define of name table to var values
        $addtotable = mysqli_query($conn, "INSERT INTO `stock` (namabarang, deskripsi, stock, harga) values ('$namabarang', '$deskripsi', '$stock', '$hargasatuan')");
        if($addtotable){
            //If true, generate to index.php
            header('location:index.php');
        }else{
            header('location:index.php');
        };
    };

    //Add Incoming Material Stock
    if(isset($_POST['barangmasuk'])){
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $cekstocksekarang = mysqli_query($conn, "SELECT * FROM `stock` where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;

        $addtomasuk = mysqli_query($conn, "INSERT INTO `masuk` (idbarang, keterangan, qty) values ('$barangnya', '$penerima', '$qty')");

        $updatestockmasuk = mysqli_query($conn, "UPDATE `stock` SET stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");

        if($addtomasuk&&$updatestockmasuk){
            header('location:incoming.php');
        }else{
            header('location:incoming.php');
        };
    }

    //Add Outgoing Material Stock
    if(isset($_POST['barangkeluar'])){
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $cekstocksekarang = mysqli_query($conn, "SELECT * FROM `stock` where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahkanstocksekarangdenganquantity = $stocksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO `keluar` (idbarang, penerima, qty) values ('$barangnya', '$penerima', '$qty')");

        $updatestockmasuk = mysqli_query($conn, "UPDATE `stock` SET stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");

        if($addtokeluar&&$updatestockmasuk){
            header('location:outgoing.php');
        }else{
            header('location:outgoing.php');
        };
    }


    //Update Info Material
    if(isset($_POST['updatebarang'])){
        $idb = $_POST['idb'];
        $namabarang = $_POST['namabarang'];
        $deskripsi = $_POST['deskripsi'];

        $update = mysqli_query($conn, "UPDATE `stock` SET namabarang ='$namabarang', deskripsi ='$deskripsi' where idbarang ='$idb'");
        if($update){
            header('location:index.php');
        }else{
            header('location:index.php');
        };
    }

    //Delete Material List
    if(isset($_POST['hapusbarang'])){
        $idb = $_POST['idb'];

        $hapus = mysqli_query($conn, "DELETE FROM `stock` where idbarang='$idb'");
        if($delete){
            header('location:index.php');
        }else{
            header('location:index.php');
        };
    
    };

    //Update Material Incoming
    if(isset($_POST['updatebarangmasuk'])){
        $idb = $_POST['idb'];
        $idm = $_POST['idm'];
        $deskripsi = $_POST['keterangan'];
        $qty = $_POST['qty'];

        $lihatstock = mysqli_query($conn, "SELECT * FROM `stock` where idbarang='$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['stock'];

        $qtyskrg = mysqli_query($conn, "SELECT * FROM `masuk` where idmasuk='$idm'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['stock'];

        if($qty>$qtyskrg){
            $selisih = $qty - $qtyskrg;
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE `stock` SET stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn, "UPDATE `masuk` SET qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");

                if($kurangistocknya&&$updatenya){
                    header('location:incoming.php');
                }else{
                    echo'Failed';
                    header('location:incoming.php');
                }
        }else{
            $selisih = $qtyskrg - $qty;
            $kurangin = $stockskrg + $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE `stock` SET stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn, "UPDATE `masuk` SET qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");

                if($kurangistocknya&&$updatenya){
                    header('location:incoming.php');
                }else{
                    echo'Failed';
                    header('location:incoming.php');
                };
        };

    };

    //Delete Material Incoming
    if(isset($_POST['hapusbarangmasuk'])){
        $idb = $_POST['idb'];
        $qty = $_POST['kty'];
        $idm = $_POST['idm'];

        $getdatastock = mysqli_query($conn, "SELECT * FROM `stock` where idbarang='$idb'");
        $data = mysqli_fetch_array($getdatastock);
        $stok = $data['stock'];

        $selisihnya = $stok - $qty;

        $update = mysqli_query($conn, "UPDATE `stock` SET stock='$selisihnya' where idbarang='$idb'");
        $hapusdata = mysqli_query($conn, "DELETE FROM `masuk` where idmasuk='$idm'");

            if($update&&$hapusdata){
                header('location:incoming.php');
            }else{
                header('location:incoming.php');
            }
    }

     //Add New User
     if(isset($_POST['addnewuser'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $dept = $_POST['dept'];
        $rolekey = $_POST['rolekey'];

        $addtotableuser = mysqli_query($conn, "INSERT INTO `login` (nama, email, pass, dept, rolekey) values ('$nama', '$email', '$pass', '$dept', '$rolekey')");
        if($addtotableuser){
            header('location:dashboard.php');
        }else{
            header('location:dashboard.php');
        };
    };
   

    //Purchase Request Material


?>  