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
    <div id="dropArea">
        <p id="dropAreaText">Drag and drop files here or click to select</p>
        <p id="selectedFilesText"></p> <!-- Placeholder for selected file names -->
    </div>
        <input type="file" name="files[]" id="fileInput" multiple required>
    <input type="hidden" id="hiddenApiKey" name="apiKey">
    <input type="hidden" id="hiddenApiSecret" name="apiSecret">
    <input type="hidden" id="hiddenJwt" name="jwt">
    <button type="submit" class="button">Upload</button>
</form>

<div id="progressContainer" style="display: none;">
    <progress id="uploadProgress" value="0" max="100"></progress>
    <span id="progressPercentage">0%</span>
</div>

    <!-- Tabs for different file categories -->
    <ul class="nav nav-tabs" id="fileTabs">
        <li class="nav-item">
            <a style="color:#2196F3 !important" class="nav-link active" data-toggle="tab" href="#images">Images</a>
        </li>
        <li class="nav-item">
            <a style="color:#2196F3 !important" class="nav-link" data-toggle="tab" href="#videos">Videos</a>
        </li>
        <li class="nav-item">
            <a style="color:#2196F3 !important" class="nav-link" data-toggle="tab" href="#documents">Documents</a>
        </li>
        <li class="nav-item">
            <a style="color:#2196F3 !important" class="nav-link" data-toggle="tab" href="#codes">Codes</a>
        </li>
        <li class="nav-item">
            <a style="color:#2196F3 !important" class="nav-link" data-toggle="tab" href="#archives">Archives</a>
        </li>
        <li class="nav-item">
            <a style="color:#2196F3 !important" class="nav-link" data-toggle="tab" href="#software">Software</a>
        </li>
    </ul>

    <!-- Tab content for uploaded files -->
    <div class="tab-content">
        <div id="images" class="tab-pane fade show active">
            <ul id="uploadedImagesList"></ul>
        </div>
        <div id="videos" class="tab-pane fade">
            <ul id="uploadedVideosList"></ul>
        </div>
        <div id="documents" class="tab-pane fade">
            <ul id="uploadedDocumentsList"></ul>
        </div>
        <div id="codes" class="tab-pane fade">
            <ul id="uploadedCodesList"></ul>
        </div>
        <div id="archives" class="tab-pane fade">
            <ul id="uploadedArchivesList"></ul>
        </div>
        <div id="software" class="tab-pane fade">
            <ul id="uploadedSoftwareList"></ul>
        </div>
    </div>
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
    // Load keys from local storage
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

    // Check if the user has visited before
    const hasVisited = localStorage.getItem("hasVisited");

    if (!hasVisited) {
        showOverlay();
        localStorage.setItem("hasVisited", "true");
    } else {
        document.getElementById("overlay").style.display = "none"; // Ensure overlay is hidden
    }
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

    // Reload the page to reflect changes
    location.reload();
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

function saveUploadedFile(fileName, ipfsHash, sha256Hash, uploadDate, fileSize) {
    console.log(`Saving file: ${fileName} with IPFS Hash: ${ipfsHash}`); // Log received filename

    const extension = fileName.split('.').pop().toLowerCase();
    
    let category;
    
    // Determine category based on file extension
    if ([
        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 
        'svg', 'webp', 'heif', 'heic', 'raw', 'ico', 'jfif'
    ].includes(extension)) {
        category = 'images';
    } else if ([
        'mp4', 'avi', 'mov', 'mkv', 'flv', 'wmv', 
        'webm', 'mpeg', 'mpg', '3gp', '3g2', 'asf'
    ].includes(extension)) {
        category = 'videos';
    } else if ([
        'zip', 'rar', 'tar', 'gz', '7z', 
        'bz2', 'xz', 'iso', 'cab'
    ].includes(extension)) {
        category = 'archives';
    } else if ([
        'exe', 'dmg', 'msi',
        'deb', 'rpm',
        'apk',
        'bin',  // Binary files
        'lib'   // Library files
    ].includes(extension)) {
        category = 'software';
    } else if ([
        'pdf',
        'doc', 'docx',
        'xls', 'xlsx',
        'ppt', 'pptx',
        'txt',
        'csv',
        'odt',
        'ods',
        'odp',
        'rtf',
        // Removed xml as it's already in code section
    ].includes(extension)) {
        category = 'documents';
    } else if ([
        // Code and Script Files
        'js',      // JavaScript files
        'html',    // HTML files
        'css',     // CSS files
        // Configuration Files
        '.env',
        '.ini',
        '.json',
        '.yaml',
        '.xml',
        // Other Formats
        '.sh'      // Shell script files
    ].includes(extension)) {
        category = "code";
    } else {
        console.warn(`Unsupported file type: ${extension}`);
        return; // Ignore unsupported file types
    }

    let uploadedFiles = JSON.parse(localStorage.getItem(category)) || [];
    
    // Save file details including size
    uploadedFiles.push({ 
        name: fileName,
        size: fileSize, // Add file size 
        hash: ipfsHash,
        sha256: sha256Hash,
        date: uploadDate 
    });
    
    localStorage.setItem(category, JSON.stringify(uploadedFiles));
    
    // Debugging information to confirm saving
    console.log(`Saved ${uploadedFiles.length} files in category: ${category}`);
    console.log(`Received fileName: ${fileName}`);
}

// Function to load uploaded files based on category
function loadUploadedFiles() {
     // Load images
     loadCategoryFiles('images', 'uploadedImagesList');
     
     // Load videos
     loadCategoryFiles('videos', 'uploadedVideosList');
     
     // Load Documents 
     loadCategoryFiles('documents', 'uploadedDocumentsList');
     
     // Load Codes 
     loadCategoryFiles('codes', 'uploadedCodesList');
     
     // Load archives
     loadCategoryFiles('archives', 'uploadedArchivesList');
     
     // Load software
     loadCategoryFiles('software', 'uploadedSoftwareList');
}

// Generic function to load files for a specific category
function loadCategoryFiles(category, listId) {
    let uploadedFiles = JSON.parse(localStorage.getItem(category)) || [];
    const listContainer = document.getElementById(listId);
    
    listContainer.innerHTML = ""; // Clear existing list

    uploadedFiles.forEach(file => {
        const listItem = document.createElement("li");
        listItem.classList.add("file-item");

        // Determine thumbnail based on file type
        let thumbnail = '';
        const extension = file.name.split('.').pop().toLowerCase();

        // Determine thumbnail based on file extension
if ([
    'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 
    'svg', 'webp', 'heif', 'heic', 'raw', 'ico', 'jfif'
].includes(extension)) {
    thumbnail = `<img src='src/imageThumbnail.png' class='file-thumbnail' alt='Image Thumbnail'>`;
} else if ([
    'mp4', 'avi', 'mov', 'mkv', 'flv', 'wmv',
    'webm', 'mpeg', 'mpg', '3gp', '3g2', 'asf'
].includes(extension)) {
    thumbnail = `<img src='src/videoThumbnail' class='file-thumbnail' alt='Video Thumbnail'>`;
} else if ([
    'zip', 'rar', 'tar', 'gz', '7z',
    'bz2', 'xz', 'iso', 'cab'
].includes(extension)) {
    thumbnail = `<img src='src/archiveThumbnail' class='file-thumbnail' alt='Archive Thumbnail'>`;
} else if ([
    'exe', 'dmg', 'msi',
    'deb', 'rpm',
    'apk',
    'bin',
    'lib'
].includes(extension)) {
    thumbnail = `<img src='src/softwareThumbnail.png' class='file-thumbnail' alt='Software Thumbnail'>`;
} else if ([
    'pdf',
    'doc', 'docx',
    'xls', 'xlsx',
    'ppt', 'pptx',
    'txt',
    'csv',
    'odt',
    'ods',
    'odp',
    'rtf',
    '.xml'
].includes(extension)) {
    thumbnail = `<img src='src/documentThumbnail.png' class='file-thumbnail' alt='Document Thumbnail'>`;
} else if ([
    // Code and Script Files
    '.js',
    '.html',
    '.css',
    // Configuration Files
    '.env',
    '.ini',
    '.json',
    '.yaml',
    // Other Formats
    '.sh'
].includes(extension)) {
    thumbnail = `<img src='src/codeThumbnail' class='file-thumbnail' alt='Code Thumbnail'>`;
} else {
    thumbnail = `<img src='src/defaultThumbnail.png' class='file-thumbnail' alt='Default Thumbnail'>`; // Default thumbnail for unsupported types
}

        listItem.innerHTML = `
    ${thumbnail}
    <div style="border-bottom:1px;">
        <div>Name: <span><a style="color:#199909 !important" href='https://gateway.pinata.cloud/ipfs/${file.hash}' target='_blank'>${file.name}</a></span></div>
        <div>Size: <span>
    Size: 
    ${file.size < 1024 ? file.size + ' bytes' : 
      file.size < 1048576 ? (file.size / 1024).toFixed(2) + ' KB' : 
      file.size < 1073741824 ? (file.size / 1048576).toFixed(2) + ' MB' : 
      file.size < 1099511627776 ? (file.size / 1073741824).toFixed(2) + ' GB' : 
      file.size < 1125899906842624 ? (file.size / 1099511627776).toFixed(2) + ' TB' : 
      (file.size / 1125899906842624).toFixed(2) + ' PB'}
</span></div>
        <div style="display: inline-block">IPFS Hash: <span style="font-size:9px">${file.hash}</span></div>
        <div style="display: inline-block">SHA-256 Hash: <span style="font-size:9px">${file.sha256}</span></div>
        <div style="display: inline-block">Upload Date: <span>${new Date(file.date).toLocaleString()}</span></div>
        
        <!-- Social Share Buttons -->
        <div style="margin-top: 10px;">
            <span>Share on:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://gateway.pinata.cloud/ipfs/${file.hash}" target="_blank">
                <span class="iconify" data-icon="logos:facebook" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
            <a href="https://twitter.com/intent/tweet?url=https://gateway.pinata.cloud/ipfs/${file.hash}&text=Check%20out%20this%20file!" target="_blank">
                <span class="iconify" data-icon="logos:twitter" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://gateway.pinata.cloud/ipfs/${file.hash}" target="_blank">
                <span class="iconify" data-icon="logos:linkedin" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
            <a href="whatsapp://send?text=Check%20out%20this%20file!%20https://gateway.pinata.cloud/ipfs/${file.hash}" target="_blank">
                <span class="iconify" data-icon="logos:whatsapp" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
        </div>
    </div>
`;
        
        listContainer.appendChild(listItem);
    });
}
let currentPage = 1;
const itemsPerPage = 19; // Number of items to display per page
let currentCategory = 'images'; // Default category

function updatePaginationControls(totalPages) {
    document.getElementById('prevPageBtn').classList.toggle('hidden', currentPage === 1);
    document.getElementById('nextPageBtn').classList.toggle('hidden', currentPage === totalPages);
    
    document.getElementById('pageInfo').innerText = `Page ${currentPage} of ${totalPages}`;
}

function changePage(direction) {
    currentPage += direction;

    // Ensure current page is within bounds
    if (currentPage < 1) currentPage = 1;

    const uploadedFiles = JSON.parse(localStorage.getItem(currentCategory)) || [];
    const totalPages = Math.ceil(uploadedFiles.length / itemsPerPage);

    if (currentPage > totalPages) currentPage = totalPages;

    loadCategoryFiles(currentCategory, 'uploaded' + capitalizeFirstLetter(currentCategory) + 'List'); // Reload files for the new page
}

function loadCategoryFiles(category, listId) {
    let uploadedFiles = JSON.parse(localStorage.getItem(category)) || [];
    
    // Calculate start and end index for slicing the array
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    // Clear existing list
    const listContainer = document.getElementById(listId);
    listContainer.innerHTML = ""; 

    // Slice the array for current page
    const currentFiles = uploadedFiles.slice(startIndex, endIndex);
    
    currentFiles.forEach(file => {
        const listItem = document.createElement("li");
        listItem.classList.add("file-item");

        // Determine thumbnail based on file type (as previously described)
        let thumbnail = '';
        const extension = file.name.split('.').pop().toLowerCase();
        
        // Determine thumbnail based on file extension
if ([
    'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 
    'svg', 'webp', 'heif', 'heic', 'raw', 'ico', 'jfif'
].includes(extension)) {
    thumbnail = `<img src='src/imageThumbnail.png' class='file-thumbnail' alt='Image Thumbnail'>`;
} else if ([
    'mp4', 'avi', 'mov', 'mkv', 'flv', 'wmv',
    'webm', 'mpeg', 'mpg', '3gp', '3g2', 'asf'
].includes(extension)) {
    thumbnail = `<img src='src/videoThumbnail' class='file-thumbnail' alt='Video Thumbnail'>`;
} else if ([
    'zip', 'rar', 'tar', 'gz', '7z',
    'bz2', 'xz', 'iso', 'cab'
].includes(extension)) {
    thumbnail = `<img src='src/archiveThumbnail' class='file-thumbnail' alt='Archive Thumbnail'>`;
} else if ([
    'exe', 'dmg', 'msi',
    'deb', 'rpm',
    'apk',
    'bin',
    'lib'
].includes(extension)) {
    thumbnail = `<img src='src/softwareThumbnail.png' class='file-thumbnail' alt='Software Thumbnail'>`;
} else if ([
    'pdf',
    'doc', 'docx',
    'xls', 'xlsx',
    'ppt', 'pptx',
    'txt',
    'csv',
    'odt',
    'ods',
    'odp',
    'rtf',
    '.xml'
].includes(extension)) {
    thumbnail = `<img src='src/documentThumbnail.png' class='file-thumbnail' alt='Document Thumbnail'>`;
} else if ([
    // Code and Script Files
    '.js',
    '.html',
    '.css',
    // Configuration Files
    '.env',
    '.ini',
    '.json',
    '.yaml',
    // Other Formats
    '.sh'
].includes(extension)) {
    thumbnail = `<img src='src/codeThumbnail' class='file-thumbnail' alt='Code Thumbnail'>`;
} else {
    thumbnail = `<img src='src/defaultThumbnail.png' class='file-thumbnail' alt='Default Thumbnail'>`; // Default thumbnail for unsupported types
}

        listItem.innerHTML = `
    ${thumbnail}
    <div>
        <div>Name: <span><a style="color:#199909 !important" href='https://gateway.pinata.cloud/ipfs/${file.hash}' target='_blank'>${file.name}</a></span></div>
        <div>Size: <span>
    Size: 
    ${file.size < 1024 ? file.size + ' bytes' : 
      file.size < 1048576 ? (file.size / 1024).toFixed(2) + ' KB' : 
      file.size < 1073741824 ? (file.size / 1048576).toFixed(2) + ' MB' : 
      file.size < 1099511627776 ? (file.size / 1073741824).toFixed(2) + ' GB' : 
      file.size < 1125899906842624 ? (file.size / 1099511627776).toFixed(2) + ' TB' : 
      (file.size / 1125899906842624).toFixed(2) + ' PB'}
</span></div>
        <div style="display: inline-block">IPFS Hash: <span style="font-size:9px">${file.hash}</span></div>
        <div style="display: inline-block">SHA-256 Hash: <span style="font-size:9px">${file.sha256}</span></div>
        <div style="display: inline-block">Upload Date: <span>${new Date(file.date).toLocaleString()}</span></div>
        
        <!-- Social Share Buttons -->
        <div style="margin-top: 10px;">
            <span>Share on:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://gateway.pinata.cloud/ipfs/${file.hash}" target="_blank">
                <span class="iconify" data-icon="logos:facebook" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
            <a href="https://twitter.com/intent/tweet?url=https://gateway.pinata.cloud/ipfs/${file.hash}&text=Check%20out%20this%20file!" target="_blank">
                <span class="iconify" data-icon="logos:twitter" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://gateway.pinata.cloud/ipfs/${file.hash}" target="_blank">
                <span class="iconify" data-icon="logos:linkedin" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
            <a href="whatsapp://send?text=Check%20out%20this%20file!%20https://gateway.pinata.cloud/ipfs/${file.hash}" target="_blank">
                <span class="iconify" data-icon="logos:whatsapp" style="font-size: 20px; margin-right: 5px;"></span>
            </a>
        </div>
    </div>
`;
        
        listContainer.appendChild(listItem);
    });

    // Update pagination controls
    updatePaginationControls(Math.ceil(uploadedFiles.length / itemsPerPage));
}

// Utility function to capitalize the first letter of a string
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Example of setting the current category when a tab is clicked
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function() {
        currentCategory = this.getAttribute('href').substring(1); // Get category from href
        currentPage = 1; // Reset to first page when changing category
        loadCategoryFiles(currentCategory, 'uploaded' + capitalizeFirstLetter(currentCategory) + 'List'); // Load files for the selected category
    });
});

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

document.getElementById("uploadForm").onsubmit = function(event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);
    
    // Show progress container
    document.getElementById("progressContainer").style.display = "block";
    document.getElementById("uploadProgress").value = 0;
    document.getElementById("progressPercentage").innerText = "0%";

    const xhr = new XMLHttpRequest();
    
    xhr.open("POST", "upload.php", true);

    let totalBytes = 0;
    let loadedBytes = 0;

    // Calculate total bytes of all files
    for (let pair of formData.entries()) {
        if (pair[0] === "files[]") {
            const file = pair[1];
            totalBytes += file.size;
        }
    }

    // Update progress bar
    xhr.upload.onprogress = function(event) {
        if (event.lengthComputable) {
            loadedBytes += event.loaded; // Accumulate loaded bytes
            const percentComplete = (loadedBytes / totalBytes) * 100; // Calculate overall progress
            document.getElementById("uploadProgress").value = percentComplete;
            document.getElementById("progressPercentage").innerText = Math.round(percentComplete) + "%";
        }
    };

    xhr.onload = function() {
    if (xhr.status === 200) {
        try {
            const data = JSON.parse(xhr.responseText); // Parse the JSON response
            
            if (Array.isArray(data)) {
                // Handle multiple files
                data.forEach((file) => {
                    if (file.success) {
                        alert("File uploaded successfully! IPFS Hash: " + file.ipfsHash);
                        // Save uploaded file details including size
                        saveUploadedFile(
                            file.fileName,
                            file.ipfsHash,
                            file.sha256Hash,
                            file.uploadDate,
                            file.fileSize // Pass the size of the uploaded file
                        );
                    } else {
                        alert(file.message);
                    }
                });
            } else {
                alert(data.message); // Handle single file response
            }
            loadUploadedFiles(); // Reload uploaded files list
        } catch (error) {
            console.error("Error parsing JSON response:", error);
            alert("An error occurred while processing the upload response.");
        }
    } else {
        alert("Upload failed. Please try again.");
    }
    // Hide progress container after upload
    document.getElementById("progressContainer").style.display = "none";
    document.getElementById("uploadProgress").value = 0; // Reset progress bar
    document.getElementById("progressPercentage").innerText = "0%"; // Reset percentage
};

    xhr.onerror = function() {
        alert("An error occurred during the upload.");
        document.getElementById("progressContainer").style.display = "none"; // Hide progress container on error
    };

    xhr.send(formData);
};

const dropArea = document.getElementById('dropArea');
const uploadForm = document.getElementById('uploadForm');
const fileInput = document.getElementById('fileInput');
const fileList = document.getElementById('fileList');

// Prevent default behaviors for drag-and-drop
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);    
    document.body.addEventListener(eventName, preventDefaults, false); 
});

// Highlight the drop area when dragging files over it
['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
});

// Remove highlight when leaving the drop area
['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
});

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false);

// Prevent default behavior (Prevent file from being opened)
function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Highlight the drop area
function highlight() {
    dropArea.classList.add('highlight');
}

// Remove highlight from the drop area
function unhighlight() {
    dropArea.classList.remove('highlight');
}

// Handle files dropped into the drop area
function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;

    // Trigger the file upload function with the dropped files
    handleFiles(files);
}

// Function to handle multiple files
function handleFiles(files) {
    if (files.length > 0) {
        // Limit to a maximum of 8 files
        const validFiles = Array.from(files).slice(0, 8);
        
        // Clear previous file list
        fileList.innerHTML = '';

        // Add each valid file to the list and set it in the input
        for (let file of validFiles) {
            const listItem = document.createElement("div");
            listItem.innerText = file.name; // Display file name

            // Optionally add a thumbnail for images
            if (file.type.startsWith('image/')) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.style.width = '50px'; // Thumbnail size
                img.style.marginRight = '10px';
                listItem.prepend(img);
            }

            fileList.appendChild(listItem); // Append to the file list

            // Create a DataTransfer object to hold the files for input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Set the input's files property to the DataTransfer object
            fileInput.files = dataTransfer.files;
        }
        
        // Optionally trigger the upload immediately or show a preview
        // uploadForm.submit(); // Automatically submit the form with the dropped files if desired
    }
}

// Optional: Allow clicking on the drop area to open file dialog
dropArea.addEventListener('click', () => {
    fileInput.click();
});
document.getElementById('fileInput').addEventListener('change', function() {
    const selectedFilesText = document.getElementById('selectedFilesText');
    
    // Clear previous file names
    selectedFilesText.innerHTML = '';

    // Get the list of selected files
    const files = this.files;

    // Check if any files are selected
    if (files.length > 0) {
        const fileNames = Array.from(files).map(file => file.name).join(', ');
        selectedFilesText.textContent = `Selected files: ${fileNames}`;
        
        // Optional - Update drop area text
        document.getElementById('dropAreaText').textContent = 'You can add more files or click Upload.';
    } else {
        selectedFilesText.textContent = ''; // Clear if no files are selected
        document.getElementById('dropAreaText').textContent = 'Drag and drop files here or click to select';
    }
});
    </script>
</body>
</html>