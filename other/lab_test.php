<?php
    
    // try {
    //     $db = mysqli_connect('localhost','root','','login_system');
    // } catch (Exception $e) {
    //     echo $e;
    // }
    // $conn = $db;
    // $query = "SHOW TABLES;";
    // $result = mysqli_query($conn,$query);
    // $tables = mysqli_fetch_all($result);
    // mysqli_free_result($result);
    // mysqli_close($conn);
    // var_dump($tables);
    // echo count($tables);

    //=================================== LAB TEST PASSED ========================================================================

    function encrypt(){
        global $password;
        $password = "012345678";    
        $randLetters = array("545HDFGXMFNJDHHSCFNGJIFNFG","7899KIOVFNENFDDSVJBITHGVBAKFRY","64977VTGIZXHKCHJDGWFYDINHCV","450KICADMPJHFBGHFVHFB","JTTSXCLAORVJOD328FB","JSQMLFHAM468ASBFEHI","ATMEGA328PCBCVGJRF","OHM546CCSCJFGBKSDHYGDYE","ASSASCOUDWITEOGIAV4555","D8979HFGHJHGDIRBVFMGNJGHRU","J261646VHGIGHRBGXVCGJGFVFH","PF658979JGOJGRGIVCBUVSREP","NE555CCHGHJIW","TADA2030GTROUYVHDG");
        $randNo = rand(0,count($randLetters));
        $base = $randLetters[$randNo];
        $encoded_base64 = base64_encode($password);
        $final_passcode = $base.$encoded_base64;
            echo $final_passcode;
        }   

    
