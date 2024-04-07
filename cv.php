<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://source.unsplash.com/1920x1080/?resume');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color:  #f0f0f0;;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.2);
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            color: #333;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="generatepdf.php" method="post" enctype="multipart/form-data">
            <div class="section">
                <h3>Informations personnelles:</h3>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom:</label>
                    <input type="text" class="form-control" name="nom" id="nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom:</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age:</label>
                    <input type="text" class="form-control" name="age" id="age" required>
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">Téléphone:</label>
                    <input type="tel" class="form-control" name="tel" id="tel" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="filiere" class="form-label">Filière:</label>
                    <input type="text" class="form-control" name="filiere" id="filiere" required>
                </div>
                <div class="mb-3">
                    <label for="niveau" class="form-label">Niveau:</label>
                    <input type="text" class="form-control" name="niveau" id="niveau" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control-file" name="image" id="image" required>
                </div>
            </div>
            
            <div class="section">
                <h3>Compétences:</h3>
                <div class="mb-3">
                    <textarea class="form-control" name="competences" id="competences" required></textarea>
                </div>
            </div>

            <div class="section">
                <h3>Langues:</h3>
                <div id="languages">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="language[]" id="language1" required>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" id="add-language">Ajouter une langue</button>
            </div>

            <div class="section">
                <h3>Centres d'intérêts:</h3>
                <div class="mb-3">
                    <textarea class="form-control" name="Interest" id="Interest"></textarea>
                </div>
            </div>

            <div class="section">
                <h3>Expériences:</h3>
                <div id="experiences">
                    <div class="mb-3">
                        <label for="poste1" class="form-label">Poste:</label>
                        <input type="text" class="form-control" name="poste1" id="poste1">
                    </div>
                    <div class="mb-3">
                        <label for="dateDebut1" class="form-label">Date de début:</label>
                        <input type="text" class="form-control" name="dateDebut1" id="dateDebut1">
                    </div>
                    <div class="mb-3">
                        <label for="dateFin1" class="form-label">Date de fin:</label>
                        <input type="text" class="form-control" name="dateFin1" id="dateFin1">
                    </div>
                    <div class="mb-3">
                        <label for="lieu1" class="form-label">Lieu:</label>
                        <input type="text" class="form-control" name="lieu1" id="lieu1">
                    </div>
                    <div class="mb-3">
                        <label for="description1" class="form-label">Description:</label>
                        <textarea class="form-control" name="description1" id="description1"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" id="add-experience">Ajouter une expérience</button>
            </div>

            <div class="section">
                <h3>Formations:</h3>
                <div id="formations">
                    <div class="mb-3">
                        <label for="ecole1" class="form-label">Etablissement:</label>
                        <input type="text" class="form-control" name="ecole1" id="ecole1">
                    </div>
                    <div class="mb-3">
                        <label for="dateDebutFormation1" class="form-label">Date de début:</label>
                        <input type="text" class="form-control" name="dateDebutFormation1" id="dateDebutFormation1">
                    </div>
                    <div class="mb-3">
                        <label for="dateFinFormation1" class="form-label">Date de fin:</label>
                        <input type="text" class="form-control" name="dateFinFormation1" id="dateFinFormation1">
                    </div>
                    <div class="mb-3">
                        <label for="diplome1" class="form-label">Diplôme:</label>
                        <input type="text" class="form-control" name="diplome1" id="diplome1">
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-3" id="add-formation">Ajouter une formation</button>
            </div>
            <input type="hidden" name="numExperiences" id="numExperiences" value="1">
            <input type="hidden" name="numFormations" id="numFormations" value="1">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Générer CV</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-experience').addEventListener('click', function() {
            var experiences = document.getElementById('experiences');
            var experienceCount = experiences.getElementsByClassName('mb-3').length + 1;
            var newExperience = document.createElement('div');
            newExperience.classList.add('mb-3');
            newExperience.innerHTML = `
                <label for="poste${experienceCount}" class="form-label">Poste:</label>
                <input type="text" class="form-control" name="poste${experienceCount}" id="poste${experienceCount}">
                <label for="dateDebut${experienceCount}" class="form-label">Date de début:</label>
                <input type="text" class="form-control" name="dateDebut${experienceCount}" id="dateDebut${experienceCount}">
                <label for="dateFin${experienceCount}" class="form-label">Date de fin:</label>
                <input type="text" class="form-control" name="dateFin${experienceCount}" id="dateFin${experienceCount}">
                <label for="lieu${experienceCount}" class="form-label">Lieu:</label>
                <input type="text" class="form-control" name="lieu${experienceCount}" id="lieu${experienceCount}">
                <label for="description${experienceCount}" class="form-label">Description:</label>
                <textarea class="form-control" name="description${experienceCount}" id="description${experienceCount}"></textarea>
            `;
            experiences.appendChild(newExperience);
            // Update the hidden input field for the number of experiences
            document.getElementById('numExperiences').value = experienceCount;
        });

        document.getElementById('add-formation').addEventListener('click', function() {
            var formations = document.getElementById('formations');
            var formationCount = formations.getElementsByClassName('mb-3').length + 1;
            var newFormation = document.createElement('div');
            newFormation.classList.add('mb-3');
            newFormation.innerHTML = `
                <label for="ecole${formationCount}" class="form-label">École:</label>
                <input type="text" class="form-control" name="ecole${formationCount}" id="ecole${formationCount}">
                <label for="dateDebutFormation${formationCount}" class="form-label">Date de début:</label>
                <input type="text" class="form-control" name="dateDebutFormation${formationCount}" id="dateDebutFormation${formationCount}">
                <label for="dateFinFormation${formationCount}" class="form-label">Date de fin:</label>
                <input type="text" class="form-control" name="dateFinFormation${formationCount}" id="dateFinFormation${formationCount}">
                <label for="diplome${formationCount}" class="form-label">Diplôme:</label>
                <input type="text" class="form-control" name="diplome${formationCount}" id="diplome${formationCount}">
            `;
            formations.appendChild(newFormation);
            // Update the hidden input field for the number of formations
            document.getElementById('numFormations').value = formationCount;
        });

        document.getElementById('add-language').addEventListener('click', function() {
            var languages = document.getElementById('languages');
            var languageCount = languages.getElementsByTagName('input').length + 1;
            var newLanguage = document.createElement('div');
            newLanguage.classList.add('mb-3');
            newLanguage.innerHTML = `
                <input type="text" class="form-control" name="language${languageCount}" id="language${languageCount}" required>
            `;
            languages.appendChild(newLanguage);
        });
    </script>
</body>
</html>
