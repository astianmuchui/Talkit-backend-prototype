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

    function decrypt(){
        $password  ="7899KIOVFNENFDDSVJBITHGVBAKFRYMTI1NTI1";
        $randLetters = array("545HDFGXMFNJDHHSCFNGJIFNFG","7899KIOVFNENFDDSVJBITHGVBAKFRY","64977VTGIZXHKCHJDGWFYDINHCV","450KICADMPJHFBGHFVHFB","JTTSXCLAORVJOD328FB","JSQMLFHAM468ASBFEHI","ATMEGA328PCBCVGJRF","OHM546CCSCJFGBKSDHYGDYE","ASSASCOUDWITEOGIAV4555","D8979HFGHJHGDIRBVFMGNJGHRU","J261646VHGIGHRBGXVCGJGFVFH","PF658979JGOJGRGIVCBUVSREP","NE555CCHGHJIW","TADA2030GTROUYVHDG");   
        foreach($randLetters as $randLetter){
            if(strpos($password,$randLetter) !== false){
                $len = strlen($randLetter);
                $fin_len = strlen($password);
                // echo $len;
                $base64Encoded = substr($password,$len,$fin_len);
                // echo $base64Encoded;
                $actual = base64_decode($base64Encoded);
                echo $actual;
            }
            
        }
    }
    decrypt();

    
