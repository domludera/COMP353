<?php

class User extends Model {

    public function listing() {
        $sql = "SELECT id, email FROM users;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Find a given record by its ID
     */
    public function find($id) {
        if (!$id) {
            return $id;
        };
        $sql = "SELECT id, name, dob, email,  region, profession, image, updated_at FROM users WHERE id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
                "i", // tells you what type the vars will be (check php docs for more info)
                $id
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * 
     * Edits details about a profile.
     * @param type $id
     * @param type $title
     * @param type $description
     * @return type
     */
    public function edit($id, $email, $profession, $dob,  $name, $region, $file) {
        $target_path = "";
        $sql = "UPDATE users SET email = ?, profession = ? , dob = ?,name = ?, region=?, updated_at = ?  WHERE id = " . $id;
        if (isset($file) && !empty($file["fileToUpload"])) {
            $theFile = $_FILES["fileToUpload"];
            $target_path = self::uploadNewPicture($theFile);
            $sql .= " image= ? ";
        }
        $stmt = Database::getBdd()->prepare($sql);
        $now = date('Y-m-d H:i:s');

        $res = $stmt->bind_param(
                "ssssss", // tells you what type the vars will be (check php docs for more info)
                $email, $profession, $dob,  $name, $region, $now
        );
        $res = $stmt->execute();
        if (!$res) {
            echo $stmt->error;
            exit;
        }
        // Update the profile image        
        if (!empty($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["size"] > 55) {
            $sql = "UPDATE users SET image = ? WHERE id = " . $id;
            $theFile = $_FILES["fileToUpload"];
            $target_path = self::uploadNewPicture($theFile);
            //echo "uploads/".$target_path;            exit;
            $stmt = Database::getBdd()->prepare($sql);

            $res = $stmt->bind_param(
                    "s", // tells you what type the vars will be (check php docs for more info)
                    $target_path
            );
            $res = $stmt->execute();
            if (!$res) {
                echo $stmt->error;
                exit;
            }
        }
        $stmt->close();
    }

    /**
     * Create new user TODO:: Check if email already in use
     */
    public function create($email, $password, $name, $dob, $region, $profession) {
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO users 
                (email, password, name, dob, region, profession, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
                "ssssssss", // tells you what type the vars will be (check php docs for more info)
                $email, $password, $name, $dob, $region, $profession, $now, $now
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

    /**
     * Create new user TODO:: Check if email already in use
     */
    public function byEmail($email) {

        $sql = "SELECT * FROM users WHERE email=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
                "s", // tells you what type the vars will be (check php docs for more info)
                $email
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Validate credentials
     */
    public function validate($email, $password) {
        $sql = "SELECT * FROM users WHERE email=? AND password = ?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
                "ss", // tells you what type the vars will be (check php docs for more info)
                $email, $password
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function isAdmin($userId) {
        if (!class_exists('Privilege')) {
            require(ROOT . 'Models/Privilege.php');
        }

        $user = User::resultToArray($this->find($userId))[0];

        $privilegeManager = new Privilege();
        $adminPriv = Privilege::resultToArray($privilegeManager->byName('admin'))[0];
        return $privilegeManager->has($adminPriv['id'], $user["id"]);
    }

    public function isController($userId) {
        if (!class_exists('Privilege')) {
            require(ROOT . 'Models/Privilege.php');
        }

        $user = User::resultToArray($this->find($userId))[0];

        $privilegeManager = new Privilege();
        $controllerPriv = Privilege::resultToArray($privilegeManager->byName('controller'))[0];
        return $privilegeManager->has($controllerPriv['id'], $user["id"]);
    }

    private static function uploadNewPicture($theFile) {
        //The controller code...
        $target_dir = ROOT . "uploads/"; //the folder where files will be saved
        $allowedTypes = array("jpg", "png", "jpeg", "gif", "bmp"); // Allow certain file formats
        $max_upload_bytes = 5000000;
        $error = '';
        $message = '';
        $newRealtivePath = '';
        $uploadOk = 1;
        $target_file_name = "";
        if (isset($theFile) &&  $theFile['size'] > 2) {
            //Check if image file is a actual image or fake image
            //this is not a guarantee that malicious code may be passed in disguise

            $check = getimagesize($theFile["tmp_name"]);
            if ($check !== false) {
                $message .= "File is an image - " . $check["mime"] . ".<br>";

                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            $extension = strtolower(pathinfo(basename($theFile["name"]), PATHINFO_EXTENSION));
            //give a name to the file such that it should never collide with an existing file name.
            //$target_file_name = uniqid() . '.' . $extension;
            $target_file_name = $theFile["name"];
            $target_path = $target_dir . $target_file_name;
            //NOTE: that this file path probably should be saved to the database for later retrieval
            //You may limit the size of the incoming file... Check file size
            if ($theFile["size"] > $max_upload_bytes) {
                $error .= "Sorry, your file is too large. <br>";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (!in_array($extension, $allowedTypes)) {
                $error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error .= "Sorry, your file was not uploaded.";
            } else {// if everything is ok, try to upload file - to move it from the temp folder to a permanent folder
                if (move_uploaded_file($theFile["tmp_name"], $target_path)) {
                    $message .= "The file " . basename($theFile["name"]) . " has been uploaded as <a href='$target_path'>$target_path</a>.";
                } else {
                    $error .= "Sorry, there was an error uploading your file. <br>";
                }
            }
        }
        return $target_file_name;
    }

}

?>
