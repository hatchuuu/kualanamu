<?php
require 'functions.php';
$maskapai = query("select * from maskapai");

// Pemanggilan SQL untuk mendapatkan ID gambar dari database
$sql = "SELECT posisi, gambar FROM maskapai";
$result = $conn->query($sql);

// Menyimpan ID gambar dan nama gambar dalam array
$image_ids = array();
$gambar = array();
while ($row = $result->fetch_assoc()) {
    $image_ids[] = $row["posisi"];
    $gambar[] = $row["gambar"];
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-[1920px] h-[1080px] bg-gradient-to-br from-[#365486] to-[#0F1035]">
        <?php
        header_island();
        ?>



        <div class=" w-full h-[58px] flex items-center">
            <marquee behavior="scroll" direction="left" class="text-4xl font-bold text-white">WELCOME TO KUALANAMU INTERNATIONAL
                AIRPORT ✦ PLEASE CHOOSE YOUR CHECK IN ISLAND</marquee>
        </div>
        <div class="flex justify-evenly">

            <div class="h-[805px] w-[926px] bg-blue-900 border-black border-2 rounded-[45px] pt-10 shadow-black shadow-lg">
                <!-- logo island -->
                <div class="h-[135px] w-[850px] bg-black mx-auto rounded-[150px] flex justify-evenly items-center shadow-md shadow-black">
                    <div class="flex font-sans font-extrabold  text-white">
                        <div class="text-5xl m-auto">
                            <p>CHECK IN</p>
                            <p>ISLAND</p>
                        </div>
                        <p class=" text-yellow-400 text-[100px] ms-3 mb-4">A</p>
                    </div>
                    <img src="logomaskapai/giphy2.gif" class="rotate-90 pointer-events-none bg-black object-none h-[130px] w-[100px] pt-[25px] "></img>
                    <div>
                        <div class="flex font-sans font-extrabold  text-white">
                            <div class="text-5xl m-auto">
                                <p>CHECK IN</p>
                                <p>ISLAND</p>
                            </div>
                            <p class=" text-yellow-400 text-[100px] ms-3 mb-4">B</p>
                        </div>
                    </div>
                </div>


                <!-- list maskapai -->
                <div class="grid grid-cols-11 px-10  py-10">
                    <div class="mx-auto  grid col-span-5 ">
                        <?php
                        generateTable(1,6);
                        ?>
                    </div>
                    <div class="h-[580px] w-[20px] mx-auto rounded-[8px] bg-white shadow-md shadow-black">
                    </div>
                    <div class="mx-auto  grid col-span-5 ">
                        <?php
                        generateTable(7,12);
                        ?>
                    </div>
                </div>
            </div>

            <div class="h-[805px] w-[926px] bg-blue-900 border-black border-2 rounded-[45px] pt-10 shadow-black shadow-lg">
                <!-- logo island -->
                <div class="h-[135px] w-[850px] bg-black mx-auto rounded-[150px] flex justify-evenly items-center shadow-md shadow-black">
                    <div class="flex font-sans font-extrabold  text-white">
                        <div class="text-5xl m-auto">
                            <p>CHECK IN</p>
                            <p>ISLAND</p>
                        </div>
                        <p class=" text-yellow-400 text-[100px] ms-3 mb-4">C</p>
                    </div>
                    <img src="logomaskapai/giphy2.gif" class="-rotate-90 pointer-events-none bg-black object-none h-[130px] w-[100px] pt-[25px] "></img>
                    <div>
                        <div class="flex font-sans font-extrabold  text-white">
                            <div class="text-5xl m-auto">
                                <p>CHECK IN</p>
                                <p>ISLAND</p>
                            </div>
                            <p class=" text-yellow-400 text-[100px] ms-3 mb-4">D</p>
                        </div>
                    </div>
                </div>


                <!-- list maskapai -->
                <div class="grid grid-cols-11 px-10 py-10">
                    <div class="mx-auto  grid col-span-5 ">
                        <?php
                        generateTable(13,18);
                        ?>
                    </div>
                    <div class="h-[580px] w-[20px] mx-auto rounded-[8px] bg-white shadow-md shadow-black">
                    </div>
                    <div class="mx-auto  grid col-span-5 ">
                        <?php
                        generateTable(19,24);
                        ?>
                    </div>
                </div>
            </div>


        </div>
    </div>


</body>

</html>