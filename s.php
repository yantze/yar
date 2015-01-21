<?php
class API {
    /**
     * the doc info will be generated automatically into service info page.
     * @params
     * @return
     */
    public function some_method($parameter, $option = "foo") {
        echo "hello";
        echo $option;
        return "hahha";
    }

    public function test() {
        echo "hahahha";
        return "xxxx";
    }

    /**
     * auth is no valid any more
     * @params
     * @return
     */
    public function __auth($provider, $token) {
        if (!$provider || $provider !== $token) {
            return false;
        } else {
            return true;
        }
    }

    function __construct($p = ""){
        print_r($p);
    }

    public function exception() {
        throw new Exception("server yang exception");
    }
}

$service = new Yar_Server(new API());
$service->handle();
?>

