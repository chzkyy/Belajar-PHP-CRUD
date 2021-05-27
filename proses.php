<?php
include_once ('koneksi.php');

function tambah($koneksi){
	if ( isset($_POST['submit']) && !empty($_POST['judul']) && !empty($_POST['content']) ) {

		//menampung data dari inputan
		$title		= $_POST['judul'];
		$content 	= $_POST['content'];
		$waktu 		= date("Y-m-d H:i:s");
		
		//insert data yang di input ke dalam database
		$datas = mysqli_query( $koneksi, "insert into table_blog ( judul,content,waktu ) values ( '$title','$content','$waktu' )" ) or die(mysqli_error($koneksi));
		
		//alert 
		header('location:index.php?pesan=berhasil menambahkan data');
		exit;
	}
}

function ubah($koneksi){
	
	if (isset($_POST['submit'])) {
	
		//menampilkan data yg ingin di rubah
		$id			= $_POST['id'];
		$judul		= $_POST['judul'];
		$content	= $_POST['content'];
		
		//mengupdate data ke dalam database
		mysqli_query($koneksi, "update table_blog set judul='$judul', content='$content' where id ='$id'");
		
		//alert kembali ke index.php
		header('location:index.php?pesan=data berhasil di update');
		exit;
	}
}

function hapus($koneksi){
	// menangkap data id yang dikirim dari url
	$id = $_GET['id'];
	
	// menghapus data dari database
	mysqli_query($koneksi,"delete from table_blog where id='$id'");
	
	// kembali ke index.php
	header('location:index.php?pesan=data berhasil di delete');
	exit;
}

if ( isset ($_GET['aksi']) ) {
	
	switch( $_GET['aksi'] ) {
		
		case "add" :
			tambah($koneksi);
			break;
	
		case "update" :
			ubah($koneksi);
			break;
	
		case "delete" :	
			hapus($koneksi);
			break;

		default :
		 echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada aksi!</h3>";
            tambah($koneksi);

	}
}
?>