<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinfu</title>
    <link rel="stylesheet" href="/src/styles.css">
    <link rel="stylesheet"
         id="theme_link"
         href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/materia/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mladenplavsic/bootstrap-navbar-sidebar@master/docs/navbar-fixed-right.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mladenplavsic/bootstrap-navbar-sidebar@master/docs/navbar-fixed-left.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mladenplavsic/bootstrap-navbar-sidebar@master/docs/docs.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mladenplavsic/bootstrap-navbar-sidebar@master/docs/docs.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
</head>
<body>
          <nav style="padding:0px !important;padding-left:1rem !important;padding-right:1rem !important;box-shadow:unset !important;" class="navbar navbar-expand-md navbar-dark bg-primary fixed-top prl-1r bgray">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <a style="margin-right:4rem;" class="navbar-brand" href="/">
  <span class="logo-text">Pinfu</span>
         </a>
         <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="about_pinfu.php">About Pinfu</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="terms_of_services.php">Terms of Services</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="privacy_policy.php">Privacy Policy</a>
                  <li class="nav-item">
                  <a class="nav-link" href="pinata_challenge.php">Pinata Challenge</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="https://github.com/imabutahersiddik/pinfu">
                  Find on GitHub
                  </a>
               </li>
            </ul>
         </div>
      </nav>
    <h1>Upload a File to Pinata</h1>

    <div id="keyForm">
        <h2>API Keys <a style="color:#2196F3 !important;font-size: 9px;" href="https://pinata.cloud/#/register" target="_blank">Get Keys</a></h2>
        <input type="text" id="apiKey" placeholder="API Key" required><br>
        <input type="text" id="apiSecret" placeholder="API Secret" required><br>
        <input type="text" id="jwt" placeholder="JWT" required><br>
        <button onclick="saveKeys()">Save Keys</button>
        <button onclick="removeKeys()" class="hidden" id="removeKeysBtn">Remove Keys</button>
    </div>

    <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <input type="hidden" id="hiddenApiKey" name="apiKey">
        <input type="hidden" id="hiddenApiSecret" name="apiSecret">
        <input type="hidden" id="hiddenJwt" name="jwt">
        <button type="submit">Upload</button>
    </form>

    <h2>Uploaded Files</h2>
    <ul id="uploadedFilesList"></ul>
    <div id="paginationControls">
    <button id="prevPageBtn" onclick="changePage(-1)" class="hidden">Previous</button>
    <span id="pageInfo"></span>
    <button id="nextPageBtn" onclick="changePage(1)" class="hidden">Next</button>
</div>
<div id="overlay" style="display: none;">
    <div id="overlayContent">
        <div class="overlaySection active" id="welcomeSection">
            <h2>Welcome to Pinata File Upload</h2>
            <p>Pinata is a powerful platform for managing and storing files on the InterPlanetary File System (IPFS). With Pinata, you can easily upload, manage, and share your files securely.</p>
        </div>

        <div class="overlaySection hidden" id="fileTypesSection">
            <h3>What Kind of Files Can You Upload?</h3>
            <p>Pinata allows you to upload various types of files including images, videos, documents, and other digital assets. Whether you're working on NFTs, decentralized applications, or simply want to store files securely, Pinata has you covered.</p>
        </div>

        <div class="overlaySection hidden" id="importanceSection">
            <h3>Importance of Pinata</h3>
            <p>Pinata simplifies the process of storing files on IPFS. It ensures that your files are always accessible and retrievable while providing a user-friendly interface for managing your uploads. With Pinata, you don’t have to worry about the complexities of IPFS; it handles everything for you.</p>
        </div>

        <div class="overlaySection hidden" id="featuresSection">
            <h3>Features of Pinata</h3>
            <ul>
                <li><strong>Easy Uploads:</strong> Effortlessly upload files using their intuitive interface.</li>
                <li><strong>File Management:</strong> Organize and manage your uploaded files with ease.</li>
                <li><strong>Secure Storage:</strong> Your files are stored securely on IPFS with redundancy.</li>
                <li><strong>API Access:</strong> Integrate Pinata into your applications using their robust API.</li>
                <li><strong>Analytics:</strong> Monitor your file usage and performance through analytics tools.</li>
            </ul>
        </div>

        <div class="overlaySection hidden" id="apiKeysSection">
            <h3>Get Your Pinata API Keys</h3>
            <p>To start using Pinata, you'll need to obtain your API keys. Click the link below to get started:</p>
            <a href="https://pinata.cloud/#/register" target="_blank">Get Pinata API Keys</a>
        </div>

        <button id="nextButton">Next</button>
        <button id="closeButton">Close</button>
    </div>
</div>
    <script>
        // Load keys from local storage
        window.onload = function() {
            const apiKey = localStorage.getItem('apiKey');
            const apiSecret = localStorage.getItem('apiSecret');
            const jwt = localStorage.getItem('jwt');

            if (apiKey && apiSecret && jwt) {
                document.getElementById('apiKey').value = apiKey;
                document.getElementById('apiSecret').value = apiSecret;
                document.getElementById('jwt').value = jwt;
                document.getElementById('removeKeysBtn').classList.remove('hidden');
                document.getElementById('keyForm').classList.add('hidden'); // Hide form after loading keys

                // Set hidden inputs for submission
                document.getElementById('hiddenApiKey').value = apiKey;
                document.getElementById('hiddenApiSecret').value = apiSecret;
                document.getElementById('hiddenJwt').value = jwt;
            }

            // Load uploaded files from local storage
            loadUploadedFiles();
        };

        function saveKeys() {
            const apiKey = document.getElementById('apiKey').value;
            const apiSecret = document.getElementById('apiSecret').value;
            const jwt = document.getElementById('jwt').value;

            localStorage.setItem('apiKey', apiKey);
            localStorage.setItem('apiSecret', apiSecret);
            localStorage.setItem('jwt', jwt);

            document.getElementById('removeKeysBtn').classList.remove('hidden');
            document.getElementById('keyForm').classList.add('hidden'); // Hide form after saving keys
            alert("Keys saved successfully!");
        }

        function removeKeys() {
            localStorage.removeItem('apiKey');
            localStorage.removeItem('apiSecret');
            localStorage.removeItem('jwt');

            document.getElementById('apiKey').value = '';
            document.getElementById('apiSecret').value = '';
            document.getElementById('jwt').value = '';
            document.getElementById('removeKeysBtn').classList.add('hidden');
            document.getElementById('keyForm').classList.remove('hidden'); // Show form again

            alert("Keys removed successfully!");
        }

        document.getElementById("uploadForm").onsubmit = function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);

            fetch("upload.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    alert("File uploaded successfully! IPFS Hash: " + data.ipfsHash);
                    saveUploadedFile(data.ipfsHash); // Save to local storage
                    loadUploadedFiles(); // Reload uploaded files list
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        };

        function saveUploadedFile(ipfsHash) {
            let uploadedFiles = JSON.parse(localStorage.getItem("uploadedFiles")) || [];
            uploadedFiles.push(ipfsHash);
            localStorage.setItem("uploadedFiles", JSON.stringify(uploadedFiles));
        }

        function loadUploadedFiles() {
            let uploadedFiles = JSON.parse(localStorage.getItem("uploadedFiles")) || [];
            const listContainer = document.getElementById("uploadedFilesList");
            
            listContainer.innerHTML = ""; // Clear existing list
            
            uploadedFiles.forEach(hash => {
                const listItem = document.createElement("li");
                listItem.innerHTML = `IPFS Hash: ${hash} - 
                    <a href="https://gateway.pinata.cloud/ipfs/${hash}" target="_blank">View File</a>`;
                listContainer.appendChild(listItem);
            });
        }
        let currentPage = 1;
const itemsPerPage = 9; // Number of items to display per page

function loadUploadedFiles() {
    let uploadedFiles = JSON.parse(localStorage.getItem("uploadedFiles")) || [];
    const listContainer = document.getElementById("uploadedFilesList");
    
    // Calculate total pages
    const totalPages = Math.ceil(uploadedFiles.length / itemsPerPage);
    
    // Calculate start and end index for slicing the array
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    
    // Clear existing list
    listContainer.innerHTML = ""; 
    
    // Slice the array for current page
    const currentFiles = uploadedFiles.slice(startIndex, endIndex);
    
    currentFiles.forEach(hash => {
        const listItem = document.createElement("li");
        listItem.innerHTML = `IPFS Hash: ${hash} - 
            <a href="https://gateway.pinata.cloud/ipfs/${hash}" target="_blank">View File</a>`;
        listContainer.appendChild(listItem);
    });

    // Update pagination controls
    updatePaginationControls(totalPages);
}

function updatePaginationControls(totalPages) {
    document.getElementById('prevPageBtn').classList.toggle('hidden', currentPage === 1);
    document.getElementById('nextPageBtn').classList.toggle('hidden', currentPage === totalPages);
    
    document.getElementById('pageInfo').innerText = `Page ${currentPage} of ${totalPages}`;
}

function changePage(direction) {
    currentPage += direction;
    
    // Ensure current page is within bounds
    if (currentPage < 1) currentPage = 1;
    
    const uploadedFiles = JSON.parse(localStorage.getItem("uploadedFiles")) || [];
    const totalPages = Math.ceil(uploadedFiles.length / itemsPerPage);
    
    if (currentPage > totalPages) currentPage = totalPages;

    loadUploadedFiles(); // Reload files for the new page
}
window.onload = function() {
    const hasVisited = localStorage.getItem("hasVisited");

    if (!hasVisited) {
        showOverlay();
        localStorage.setItem("hasVisited", "true");
    } else {
        document.getElementById("overlay").style.display = "none"; // Ensure overlay is hidden
    }
};

function hideOverlay() {
    const overlay = document.getElementById("overlay");
    overlay.classList.add("hidden"); // Hide the overlay
}

// Your existing showOverlay, nextSection, etc., functions remain unchanged.

let currentSectionIndex = 0;
const sections = document.querySelectorAll('.overlaySection');
const totalSections = sections.length;

function showOverlay() {
    const overlay = document.getElementById("overlay");
    overlay.style.display = "block";
    
    overlay.classList.remove("hidden");
    
    // Show the first section
    sections[currentSectionIndex].classList.add("active");

    // Automatically switch sections every 19 seconds
    const timeoutId = setTimeout(() => {
        nextSection();
    }, 19000); // Change section after 19 seconds

    // Event listeners for buttons
    document.getElementById("nextButton").onclick = function() {
        clearTimeout(timeoutId); // Clear timeout when user clicks next
        nextSection();
    };
    
    document.getElementById("closeButton").onclick = function() {
        clearTimeout(timeoutId); // Clear timeout when user clicks close
        closeOverlay();
    };
}

function nextSection() {
    // Hide current section
    sections[currentSectionIndex].classList.remove("active");

    // Move to next section
    currentSectionIndex++;
    
    if (currentSectionIndex >= totalSections) {
        hideNextButton(); // Hide Next button on last section
        autoCloseOverlay(); // Close overlay after 9 seconds
        return;
    }

    // Show next section
    sections[currentSectionIndex].classList.add("active");

   // Reset timeout for automatic transition
   setTimeout(() => {
       nextSection();
   }, 19000); // Change section after 19 seconds
}

function hideNextButton() {
    document.getElementById("nextButton").style.display = "none"; // Hide Next button
}

function autoCloseOverlay() {
    const overlay = document.getElementById("overlay");
    
    setTimeout(() => {
        closeOverlay(); // Close overlay after 9 seconds
    }, 19000); // 9 seconds delay before closing
}

function closeOverlay() {
    const overlay = document.getElementById("overlay");
    overlay.style.display = "none"; // Hide overlay using inline CSS
}

// Set up the event listener for the Close button
document.getElementById("closeButton").onclick = closeOverlay;
    </script>
</body>
</html>