<?php
date_default_timezone_set('Asia/Jakarta');
include "function.php";
echo "\n";
echo "\n";
echo "\e[92m      **                               **   ****   **** \n";
echo "\e[92m     //                               ***  */// * */// * \n";
echo "\e[92m      **  ******   **    **  ******  //** /*   /*/*   / \n";
echo "\e[92m     /** //////** /**   /** //////**  /** / **** /*****  \n";
echo "\e[92m     /**  ******* //** /**   *******  /**  */// */*/// * \n";
echo "\e[92m   **/** **////**  //****   **////**  /** /*   /*/*   /* \n";
echo "\e[92m  //*** //********  //**   //******** ****/ **** / **** \n";
echo "\e[92m   ///   ////////    //     //////// ////  ////   ////  \n";
echo "\e[91m  =======================ⒿⒶⓋⒶ➊➑➏======================== \n";
 

				  echo "\e[91m         Time:".date('[d-m-Y] [H:i:s]')."\n";
				  echo "\e[92m      ╔══════════════════════════════════╗\n";
				  echo "\e[92m      ║   SELAMAT DATANG DI MENU GOJEK   ║\n";
				  echo "\e[92m      ║ AUTO REGISTRASI & REDEEM VOUCHER ║\n";
				  echo "\e[92m      ║   UNTUK REGISTRASI CALL ADMIN    ║\n";
				  echo "\e[92m      ║        JAPRI ADMIN @Java186      ║\n";
				  echo "\e[92m      ╚══════════════════════════════════╝\n";
				  echo "\e[93m      ╔══════════════════════════════════╗\n";
				  echo "\e[93m      ║\e[91m      VOUCHER YANG TERSEDIA       \e[93m║\n";
				  echo "\e[93m      ║▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬║\n";
				  echo "\e[93m      ║ 1. VOUCHER GOFOOD 15K MINBEL 30K ║\n";
				  echo "\e[93m      ║ 2. VOUCHER GOFOOD 10K MINBEL 30K ║\n";
				  echo "\e[93m      ║ 3. VOUCHER GORIDE 8K GOPAY       ║\n";
				  echo "\e[93m      ║ 4. VOUCHER GOCAR 14K GOPAY       ║\n";
				  echo "\e[93m      ║ 5. VOUCHER CASHBACK ALFAMART     ║\n";
				  echo "\e[93m      ║ 6. VOUCHER GOCAR CASHBACK 5K     ║\n";
				  echo "\e[93m      ║                                  ║\n";
				  echo "\e[93m      ║▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬║\n";
				  echo "\e[93m      ║\e[94m           JAVABYTECODE           \e[93m║\n";
				  echo "\e[93m      ╚══════════════════════════════════╝\n";
                  echo "\e[93m      ╔══════════════════════════════════╗\n";
                  echo "\e[91m      ║            Terimakasih           ║\n";
                  echo "\e[91m      ║     THANKS TO JAVABYTECODE       ║\n";
                  echo "\e[91m      ║          JAVABYTECODE            ║\n";
                  echo "\e[93m      ╚══════════════════════════════════╝\n";

	echo "\n";
function change(){
        $nama = nama();
        $email = str_replace(" ", "", $nama) . mt_rand(100, 999);
        echo color("purple",">] Nomor : ");
        // $no = trim(fgets(STDIN));
        $nohp = trim(fgets(STDIN));
        $nohp = str_replace("62","62",$nohp);
        $nohp = str_replace("(","",$nohp);
        $nohp = str_replace(")","",$nohp);
        $nohp = str_replace("-","",$nohp);
        $nohp = str_replace(" ","",$nohp);

        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp),0,3)=='62') {
                $hp = trim($nohp);
            }
            else if (substr(trim($nohp),0,1)=='0') {
                $hp = '62'.substr(trim($nohp),1);
        }
         elseif(substr(trim($nohp), 0, 2)=='62'){
            $hp = '6'.substr(trim($nohp), 1);
        }
        else{
            $hp = '1'.substr(trim($nohp),0,13);
        }
    }
        $data = '{"email":"'.$email.'@gmail.com","name":"'.$nama.'","phone":"+'.$hp.'","signed_up_country":"ID"}';
        $register = request("/v5/customers", null, $data);
        if(strpos($register, '"otp_token"')){
        $otptoken = getStr('"otp_token":"','"',$register);
        echo color("green",">] Kode verifikasi sudah di kirim")."\n";
        otp:
        echo color("purple",">] Otp : ");
        $otp = trim(fgets(STDIN));
        $data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"313518ee-bfeb-4ed7-a062-294597ae9eaf"}';
        $verif = request("/v5/customers/phone/verify", null, $data1);
        if(strpos($verif, '"access_token"')){
        echo color("green",">] Berhasil mendaftar\n");
        $token = getStr('"access_token":"','"',$verif);
        $uuid = getStr('"resource_owner_id":',',',$verif);
        echo color("green","+] Your access token : ".$token."\n\n");
        save("token.txt",$token);
        echo color("purple","\n▬▬▬▬▬▬▬▬▬▬▬▬AUTO REDEEM VOUCHER▬▬▬▬▬▬▬▬▬▬▬▬");
        echo "\n".color("purple",">] Claim voc EATLAH");
        echo "\n".color("green",">] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("red",".");
        sleep(10);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"EATLAH"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green",">] Message: ".$message);
        goto gocar;
        }else{
        echo "\n".color("red",">] Message: ".$message);
	      gocar:
        echo "\n".color("purple",">] Claim voc GOFOOD A");
        echo "\n".color("green",">] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("red",".");
        sleep(20);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD010420A"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai.')){
        echo "\n".color("green",">] Message: ".$message);
        goto gofood;
        }else{
        echo "\n".color("red",">] Message: ".$message);
        gofood:
        echo "\n".color("purple",">] Claim voc GOFOOD B");
        echo "\n".color("green",">] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("red",".");
        sleep(10);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD010420B"}');
        $message = fetch_value($code1,'"message":"','"');
        echo "\n".color("green",">] Message: ".$message);
        echo "\n".color("purple",">] Claim voc CASHBACK GOFOOD C");
        echo "\n".color("green",">] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("red",".");
        sleep(1);
        }
        sleep(5);
        $boba09 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD010420A"}');
        $messageboba09 = fetch_value($boba09,'"message":"','"');
        echo "\n".color("green",">] Message: ".$messageboba09);
        sleep(3);
        $cekvoucher = request('/gopoints/v3/wallet/vouchers?limit=13&page=1', $token);
        $total = fetch_value($cekvoucher,'"total_vouchers":',',');
        $voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
        $voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
        $voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
        $voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
        $voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
        $voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
        $voucher7 = getStr1('"title":"','",',$cekvoucher,"7");
        $voucher8 = getStr1('"title":"','",',$cekvoucher,"8");
        $voucher9 = getStr1('"title":"','",',$cekvoucher,"9");
        $voucher10 = getStr1('"title":"','",',$cekvoucher,"10");
        $voucher11 = getStr1('"title":"','",',$cekvoucher,"11");
        $voucher12 = getStr1('"title":"','",',$cekvoucher,"12");
        $voucher13 = getStr1('"title":"','",',$cekvoucher,"13");
        echo "\n".color("purple",">] Total voucher ".$total." : ");
        echo "\n".color("green","                     1. ".$voucher1);
        echo "\n".color("green","                     2. ".$voucher2);
        echo "\n".color("green","                     3. ".$voucher3);
        echo "\n".color("green","                     4. ".$voucher4);
        echo "\n".color("green","                     5. ".$voucher5);
        echo "\n".color("green","                     6. ".$voucher6);
        echo "\n".color("green","                     7. ".$voucher7);
        echo "\n".color("green","                     8. ".$voucher8);
        echo "\n".color("green","                     9. ".$voucher9);
        echo "\n".color("green","                     10. ".$voucher10);
      	echo "\n".color("green","                     11. ".$voucher11);
        echo "\n".color("green","                     12. ".$voucher12);
        echo "\n".color("green","                     13. ".$voucher13);
        echo"\n";
        $expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
        $expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
        $expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
        $expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
        $expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
        $expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
        $expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'7');
        $expired8 = getStr1('"expiry_date":"','"',$cekvoucher,'8');
        $expired9 = getStr1('"expiry_date":"','"',$cekvoucher,'9');
        $expired10 = getStr1('"expiry_date":"','"',$cekvoucher,'10');
        $expired11 = getStr1('"expiry_date":"','"',$cekvoucher,'11');
        $expired12 = getStr1('"expiry_date":"','"',$cekvoucher,'12');
        $expired13 = getStr1('"expiry_date":"','"',$cekvoucher,'13');
       
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch, CURLOPT_URL, $url);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post );   
                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                        $datas = curl_exec($ch);
                                        $error = curl_error($ch);
                                        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                        curl_close($ch);
                                        $debug['text'] = $pesan;
                                        $debug['respon'] = json_decode($datas, true);
         setpin:
         echo "\n".color("purple","SET PIN ANDA: y/n ");
         $pilih1 = trim(fgets(STDIN));
         if($pilih1 == "y" || $pilih1 == "Y"){
         //if($pilih1 == "y" && strpos($no, "628")){
         echo color("purple","▬▬▬▬▬▬▬▬▬▬▬▬▬▬PIN ANDA = 860000 ▬▬▬▬▬▬▬▬▬▬▬▬")."\n";
         $data2 = '{"pin":"860000"}';
         $getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
         echo "Otp pin: ";
         $otpsetpin = trim(fgets(STDIN));
         $verifotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
         echo $verifotpsetpin;
         }else if($pilih1 == "n" || $pilih1 == "N"){
         die();
         }else{
         echo color("red","-] GAGAL!!!\n");
         }
         }
         }
         }else{
         echo color("red","-] Otp yang anda input salah");
         echo"\n▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬\n\n";
         echo color("purple","!] Silahkan input kembali\n");
         goto otp;
         }
         }else{
         echo color("red","-] Nomor sudah teregistrasi");
         echo"\n▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬\n\n";
         echo color("purple","!] Silahkan registrasi kembali\n");
         goto ulang;
         }
//  }

// echo change()."\n";
