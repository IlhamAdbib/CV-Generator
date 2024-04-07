<?php
require('tcpdf.php');

// Retrieve form data
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$filiere = isset($_POST['filiere']) ? $_POST['filiere'] : '';
$niveau = isset($_POST['niveau']) ? $_POST['niveau'] : '';
$competences = isset($_POST["competences"]) ? $_POST["competences"] : "";
$langues = isset($_POST['langue']) ? $_POST['langue'] : '';
$interests = isset($_POST['Interest']) ? $_POST['Interest'] : '';

// Image processing
$uploadDir = 'uploads/';
$imageFileName = $uploadDir . basename($_FILES['image']['name']);
move_uploaded_file($_FILES['image']['tmp_name'], $imageFileName);

$imageExtension = pathinfo($imageFileName, PATHINFO_EXTENSION);//extract image extenszion
if ($imageExtension !== 'png') {
    $resizedImageFileNameWithPath = $uploadDir . 'resized_image.png';
    resizeImage($imageFileName, $resizedImageFileNameWithPath);
    $imageFileName = $resizedImageFileNameWithPath;
}

// Create PDF
$pdf = new TCPDF();
$pdf->AddPage();

// Add image on the left
if (file_exists($imageFileName)) {
    $pdf->Image($imageFileName, 10, 10, 50, 0, 'PNG');
}

// Add vertical line with start point and end point and an array to the color width ..
$pdf->Line(70, 10, 70, 300, array('width' => 0.5, 'color' => array(0, 0, 0)));

// Add personal information on the right
$html = '<div style="margin-left: 80px;">';
$html .= '<h1 style="margin-top: 0; margin-bottom: 5px; padding-bottom: 0;">' . $nom . ' ' . $prenom . ' - ' . $age . ' ans' . '</h1>';

$html .= '<p><strong>Niveau: ' . $niveau . ', ' . $filiere . '</strong></p>';
$html .= '<p><strong>Tel: </strong>' . $tel . '</p>';
$html .= '<p><strong>Email: </strong>' . $email . '</p>';

// Add competences
$html .= '<h2>Compétences:</h2>';
$html .= '<ul>';
$competenceList = explode("\n", $competences);//convert sting to array and \n is the deliùiter 
foreach ($competenceList as $competence) {
    $html .= '<li>' . $competence . '</li>';
}
$html .= '</ul>';

// Add langues
$html .= '<h2>Langues:</h2>';
$html .= '<ul>';
if(isset($_POST['langue']) && is_array($_POST['langue'])) {
    foreach ($_POST['langue'] as $langue) {
        $langue = trim($langue); // Remove leading/trailing whitespace
        if (!empty($langue)) { // Only add if the language is not empty
            $html .= '<li>' . htmlspecialchars($langue) . '</li>';
        }
    }
}
$html .= '</ul>';



// Add interests
$html .= '<h2>Centres d\'intérêts:</h2>';
$html .= '<ul>';
$interestList = explode("\n", $interests);
foreach ($interestList as $interest) {
    $html .= '<li>' . $interest . '</li>';
}
$html .= '</ul>';

$html .= '</div>';
// Add formations on the right
$pdf->SetXY(100, 40); // Adjust the X and Y coordinates as needed
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 0, 'Formations:', 0, 1, 'L');//ad the title to the left with no border  height and weight 0 and 1 means prochain action sera sur une ligne apart
$pdf->Ln(5);//retour  à la line de 5 units 
$pdf->SetFont('helvetica', '', 10);
for ($i = 1; $i <= $_POST['numFormations']; $i++) {
    $ecole = isset($_POST['ecole'.$i]) ? $_POST['ecole'.$i] : '';
    $dateDebut = isset($_POST['dateDebut'.$i]) ? $_POST['dateDebut'.$i] : '';
    $dateFin = isset($_POST['dateFin'.$i]) ? $_POST['dateFin'.$i] : '';
    $diplome = isset($_POST['diplome'.$i]) ? $_POST['diplome'.$i] : '';

    if (!empty($ecole) && !empty($dateDebut) && !empty($dateFin) && !empty($diplome)) {
        $pdf->SetX(100); // Adjust the X coordinate for the Cell function
        $pdf->Cell(0, 0, $ecole . ' (' . $dateDebut . ' - ' . $dateFin . ') - Diplôme: ' . $diplome, 0, 1, 'L');
    }
}

$pdf->Ln(10);

// Add experiences on the right
$pdf->SetX(100); // Adjust the X position
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 0, 'Expériences:', 0, 1, 'L');
$pdf->Ln(5);
$pdf->SetFont('helvetica', '', 10);
for ($i = 1; $i <= $_POST['numExperiences']; $i++) {
    $poste = isset($_POST['poste'.$i]) ? $_POST['poste'.$i] : '';
    $dateDebut = isset($_POST['dateDebut'.$i]) ? $_POST['dateDebut'.$i] : '';
    $dateFin = isset($_POST['dateFin'.$i]) ? $_POST['dateFin'.$i] : '';
    $lieu = isset($_POST['lieu'.$i]) ? $_POST['lieu'.$i] : '';
    $description = isset($_POST['description'.$i]) ? $_POST['description'.$i] : '';

    if (!empty($poste) && !empty($dateDebut) && !empty($dateFin) && !empty($lieu) && !empty($description)) {
        // Adjust the X coordinate for the Cell function
        $pdf->SetX(100);
        $pdf->Cell(0, 0, $poste . ' (' . $dateDebut . ' - ' . $dateFin . ') - ' . $lieu . ' ' . $description, 0, 1, 'L');
    }
}


$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('Resume.pdf', 'D');//,generate pdf  and d for downloaddd 

// Function to resize image
function resizeImage($sourceImagePath, $destinationImagePath) {
    list($width, $height) = getimagesize($sourceImagePath);
    $newWidth = 50; // New width
    $newHeight = ($newWidth / $width) * $height; // Calculate new height while maintaining aspect ratio
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    $sourceImage = imagecreatefromjpeg($sourceImagePath);
    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagepng($newImage, $destinationImagePath);
    imagedestroy($newImage);
    imagedestroy($sourceImage);
}
?>
