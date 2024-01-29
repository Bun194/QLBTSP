<?php
    // namespace App;
    // class Home {
    //     public  static function index(): string {
    //         return "Home";
    //     }
    // }

    namespace App;

    class Home {
        public function index(): string {
            return <<<FORM
            <form action="/upload" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload" />
                <input type="submit" value="Upload Image" name="submit">
                <a href="/login">Login</a>
            </form>
            FORM;
        }
        public function upload(){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            if(isset($_POST['submit'])) {
                echo '<pre></pre>';
                // var_dump($_FILES);
                $old_name = $_FILES['fileToUpload']['name'];
                echo $old_name . '<br />';
                $file_extension = pathinfo($old_name, PATHINFO_EXTENSION);
                $new_name = date('Y-m-d_H-i-s'). '.' .$file_extension;
                echo $new_name . '<br/>';
                move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'Public/Upload/' . $new_name);
            }
        }

    }

?>