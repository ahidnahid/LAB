<?php
// submit_form.php
session_start();
include('db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if photo is uploaded
    if (isset($_FILES['photoInput']) && $_FILES['photoInput']['error'] == 0) {
        $photo = $_FILES['photoInput'];
        $photo_name = $photo['name'];
        $photo_tmp = $photo['tmp_name'];
        $photo_type = $photo['type'];

        // Get the system's temporary directory for file storage (PHP's default)
        $photo_path = sys_get_temp_dir() . '/' . $photo_name;

        // Move the uploaded photo to the temporary directory
        if (!move_uploaded_file($photo_tmp, $photo_path)) {
            echo json_encode(['status' => 'error', 'message' => 'Error uploading photo']);
            exit();
        }
    } else {
        $photo_path = null;
    }

    // Get form data
    $full_name = $_POST['fullName'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birthDate'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $blood_type = $_POST['bloodType'];
    $marital_status = $_POST['maritalStatus'];
    $father_occupation = $_POST['fatherOccupation'];
    $mother_occupation = $_POST['motherOccupation'];
    $siblings = $_POST['siblings'];
    $family_type = $_POST['familyType'];
    $family_background = $_POST['familyBackground'];
    $highest_education = $_POST['highestEducation'];
    $major = $_POST['major'];
    $university = $_POST['university'];
    $graduation_year = $_POST['graduationYear'];
    $additional_education = $_POST['additionalEducation'];
    $hobbies = $_POST['selectedHobbies'];
    $occupation = $_POST['occupation'];
    $company = $_POST['company'];
    $work_experience = $_POST['workExperience'];
    $annual_income = $_POST['annualIncome'];
    $contact_number = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $expectations = $_POST['expectations'];
    $self_introduction = $_POST['selfIntroduction'];
    $additional_info = $_POST['additionalInfo'];
    $how_did_you_hear = $_POST['howDidYouHear'];

    $user_id = $_SESSION['user_id'];  // Use session user ID

    // Insert bio data into database
    $query = "INSERT INTO marriage_bio (user_id, full_name, gender, birth_date, height, weight, blood_type, marital_status, 
              father_occupation, mother_occupation, siblings, family_type, family_background, highest_education, major, university, 
              graduation_year, additional_education, hobbies, occupation, company, work_experience, annual_income, contact_number, 
              email, address, expectations, self_introduction, additional_info, photo_path) 
              VALUES ('$user_id', '$full_name', '$gender', '$birth_date', '$height', '$weight', '$blood_type', '$marital_status', 
                      '$father_occupation', '$mother_occupation', '$siblings', '$family_type', '$family_background', '$highest_education', 
                      '$major', '$university', '$graduation_year', '$additional_education', '$hobbies', '$occupation', '$company', 
                      '$work_experience', '$annual_income', '$contact_number', '$email', '$address', '$expectations', 
                      '$self_introduction', '$additional_info', '$photo_path')";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Profile successfully submitted']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
