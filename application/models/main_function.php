<?php
defined('BASEPATH') or exit('No direct script access allowed');

class main_function extends CI_Model
{

    public function is_stringz($str)
    {
        if (!preg_match("/^[a-zA-Z0-9_-]+$/", $str)) {
            return false;
        } else {
            return true;
        }
    }
    private function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        if ($data = curl_exec($ch)) {
            return $data;
        } else {
            $datas = array('status' => 'false');
            return json_encode($datas);
        }
        curl_close($ch);
    }

    public    function alert($alert = "", $type = "", $target = "")
    {
        echo
        '
			<html>
				<head>
					<title></title>
					<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
				</head>
				<body>
					<script>
                        ';
        echo "
                        const swalWithBootstrapButtons = Swal.mixin({
                            buttonsStyling: true,
                        })

                        swalWithBootstrapButtons.fire({
                            title: 'แจ้งเตือน',
                            text: '" . $alert . "',
                            icon: '" . $type . "',
                            showClass: {
                                popup: 'animated fadeInDown faster'
                            },
                            hideClass: {
                                popup: 'animated fadeOutUp faster'
                            },
                            showCancelButton: false,
                            confirmButtonText: 'ตกลง',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = '" . $target . "';

                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                window.location.href = '" . $target . "';
                            }
                        })
";
        echo '
					</script>
				</body>
			</html>
		';
    }
}