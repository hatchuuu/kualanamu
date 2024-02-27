<?php
$conn = mysqli_connect("localhost:3307", "root", "", "display_island");

	
function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function header_island(){
	echo "
	<header class=\"bg-[#DCF2F1] h-[196px] w-[1920px] rounded-b-[45px]\">
			<div class=\"flex justify-around py-10\">
				<img src=\"logomaskapai/angkasapura.png\" alt=\"Girl in a jacket\" class=\"h-[120px] w-auto\">
				<div class=\"flex flex-col items-center \">
					<p class=\"font-sans text-blue-900 font-extrabold text-9xl drop-shadow-lg shadow-black\">KUALANAMU</p>
					<p class=\"font-sans text-blue-900 font-bold text-4xl py-2\">INTERNATIONAL AIRPORT</p>
				</div>
				<img src=\"logomaskapai/kualanamu.png\" alt=\"Girl in a jacket\" class=\"h-[140px] w-auto\">
			</div>
		</header>
		";
}

function generateIsland($x, $rowCount) {
    for ($x; $x <= $rowCount; $x++) {
        echo "<div id=\"$x\" class=\"flex gap-4\">
            <div class=\"border rounded p-2 h-max\">
                <p class=\"\">$x</p>
            </div>
            <div class=\"mb-4\">
                <select name=\"dropdown-$x\" class=\"border rounded py-2 px-4\" onchange=\"showImage(this, $x)\">
                    " . dropdownMenu() . "
                </select>
            </div>
            <div id=\"image-container-$x\" class=\"mb-4\">
                <!-- TEMPAT GAMBAR AKAN DITAMPILKAN DI SINI -->
            </div>
            <div>
                <button type=\"submit\" onclick=\"hapusInput($x);\" class=\"bg-blue-500 text-white py-2 px-4 rounded\">Hapus</button>
            </div>
        </div>";
    }
}

function dropdownMenu() {
    global $conn;
    $options = "";
    $sql = "SELECT kode, gambar FROM maskapai";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row['kode'] . "'>" . $row['kode'] . "</option>";
        }
    }
    return $options;
}


function generateTable($row,$rowCount) {
    global $image_ids, $gambar;

    echo "<table>";
    for ($row; $row <= $rowCount; $row++) {
        echo "<tr >";

        $col = 1; // Hanya satu kolom

        $gridId = ($col - 1) * $rowCount + $row;

        // Cek apakah ada gambar dengan ID sesuai dengan posisi grid
        if (in_array($gridId, $image_ids)) {
            // Mendapatkan index gambar yang sesuai dengan posisi
            $index = array_search($gridId, $image_ids);

            $gambar_id = $gambar[$index];

            echo '<td>';
            echo "<img id=\"$gambar_id\" class=\"grid-item rounded-[150px] shadow-lg shadow-black h-[76px] w-[376px]\" src=\"logomaskapai/$gambar_id\" alt=\"Image $gambar_id\">";
            echo '</td>';
        } else {
            // Jika tidak ada gambar untuk grid ini, bisa menampilkan pesan atau elemen kosong
            echo "<td>";
			echo "<div class=\"h-[76px] w-[376px] rounded-[150px]\"></div>";
			echo  "</td>";
			
        }
        echo '</tr>';
    }
    echo '</table>';
}




function hapus($id) {
	global $conn;
	mysqli_query($conn, "delete from maskapai where id = $id");

	return mysqli_affected_rows($conn);
}

function tambah_island($data) {
	global $conn;

	$kode = $data["kode"];
	$posisi = htmlspecialchars($data["posisi"]);

	$sql = "UPDATE maskapai SET
				posisi = '$posisi'
			WHERE
				kode = $kode
			";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function tambah($data) {
	global $conn;

	$kode = htmlspecialchars($data["kode"]);
	$nama = htmlspecialchars($data["nama"]);

	// ambil data gambar
	$gambar = $_FILES["gambar"]["name"];
	$tmp_name = $_FILES["gambar"]["tmp_name"];
	$ukuran = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];

	// pengecekan gambar

	// jika user tidak pilih gambar
	if( $error == 4 ) {
		echo "<script>
				alert('harap pilih gambar terlebih dahulu!');
				document.location.href = 'tambah.php';
			  </script>";
		return false;
	}

	// jika ukuran file melebihi 5MB
	if( $ukuran > 5000000 ) {
		echo "<script>
				alert('ukuran file terlalu besar!');
				document.location.href = 'tambah.php';
			  </script>";
		return false;
	}

	// jika bukan gambar
	$tipeGambarAman = ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensiGambar = explode('.', $gambar);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if( ! in_array($ekstensiGambar, $tipeGambarAman) ) {
		echo "<script>
				alert('yang anda pilih bukan gambar!');
				document.location.href = 'tambah.php';
			  </script>";
		return false;
	}

	move_uploaded_file($tmp_name, 'logomaskapai/' . $gambar);

	$sql = "INSERT INTO maskapai (kode, nama, gambar)VALUES ('$kode', '$nama', '$gambar')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}


function ubah($data) {
	global $conn;

	$id = $data["id"];
	$kode = htmlspecialchars($data["kode"]);
	$nama = htmlspecialchars($data["nama"]);
	$gambar = htmlspecialchars($data["gambar"]);

	$sql = "UPDATE maskapai SET
				kode = '$kode',
				nama = '$nama',
				gambar = '$gambar'
			WHERE
				id = $id
			";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}




?>