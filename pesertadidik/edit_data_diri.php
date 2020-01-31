<?php
@session_start();

include "../config/database.php";

$tampil = mysqli_fetch_array(mysqli_query("SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'")) ;

if (empty($_SESSION['username'])) {
    echo "<script>alert('Anda belum melakukan login');document.location.href='index.php'</script>";
}

if ($tampil['jk'] == "L") {
    $l = "checked";
} else{
    $p = "checked";
}
$date = explode("-", $tampil['tgl_lahir']);
$thn = $date[0];
$thn = $date[1];
$thn = $date[2];

$perintah = new oop() ;
$table = "tbl_siswa";
$tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
$field = array('nama' => $_POST['nama'], 'jk' => $_POST['jk'], 'id_rayon' => $_POST['rayon'], 
    'id_rombel' => $_POST['rombel'], 'tgl_lahir' => $tanggal);
$where = "nis = $_GET[nis]";
$redirect = "?menu=lihat_data";

if (isset($_POST['ubah'])) {
    echo $perintah->ubah($table, $field, $where, $redirect);
    echo "ok";
}
?>

<title>Form Siswa</title>
<form method="post">
    <table align="center">
        <tr>
            <td></td>
            <td><img border="5" height="175" width="155" src="../foto/<?php echo $tampil['foto'] ?>"></td>
            <td></td>
        </tr>
    </table>
    <table align="center">
        <tr>
            <td>NIS</td>
            <td> : </td>
            <td><?php echo $tampil['nis'] ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td> : </td>
            <td><input type="text" name="nama" value="<?php echo $tampil['nama'] ?>"></td>
        </tr>
        <tr>
            <td>Kelamin</td>
            <td> : </td>
            <td><input type="radio" name="jk" value="L" <?php echo $l ?> />Laki-Laki
                <input type="radio" name="jk" value="P" <?php echo $p ?> />Perempuan
            </td>
        <tr>
            <td>Rayon</td>
            <td> : </td>
            <td><select name="rayon">
                    <option value="<?php echo $tampil['id_rayon'] ?>"><?php echo $tampil['rayon']; ?></option>
                    <?php
                    $E = mysqli_query("select * from tbl_rayon");
                    while ($r = mysqli_fetch_array($E)) {
                        ?>
                        <option value="<?php echo $r[0] ?>"><?php echo $r[1] ?></option>
                    <?php } ?>
                </select></td>
            </tr>
            <tr>
                <td>Rombel/td>
                <td> : </td>\
                <td><select name="rombel">
                        <option value="<?php echo $tampil['id_rombel'] ?>"><?php echo $tampil['rombel']; ?></option>
                        <?php
                        $E = mysqli_query("select * from tbl_rombel");
                        while ($r = mysqli_fetch_array($E)) {
                            ?>
                            <option value="<?php echo $r[0] ?>"><?php echo $r[1] ?></option>
                        <?php  } ?>
                    </select></td>
                </tr

            
