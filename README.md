# PinFu - Pinata File Upload

PinFu is a web-based application that allows users to upload files to the Pinata platform seamlessly. Built using PHP, PinFu provides a user-friendly interface for managing API keys, uploading files, and viewing uploaded files on IPFS.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [File Upload Process](#file-upload-process)
- [Viewing Uploaded Files](#viewing-uploaded-files)
- [Future Enhancements](#future-enhancements)
- [License](#license)

## Features

- Save and manage your Pinata API keys securely through the UI.
- Upload various types of files (images, videos, documents) to Pinata.
- View the IPFS hash and link for each uploaded file.
- User-friendly interface for easy navigation.

## Requirements

- PHP 7.4 or higher
- A web server (e.g., Apache, Nginx)
- Access to the internet for API requests

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/imabutahersiddik/pinfu.git
   cd pinfu
   php -S localhost:8000
   ```

2. **Ensure Composer dependencies are installed**:
   - Composer is already installed in the repository, so no additional installation is necessary.

3. **Configure your web server**:
   - Set the document root to the directory where you cloned the repository.
   - Ensure that the server has write permissions to the necessary directories.

4. **Access the application**:
   Open your web browser and navigate to `http://localhost:8000/pinfu` (or your configured domain).

## Usage

1. **API Key Management**:
   - Navigate to the API Key section.
   - Enter your Pinata API Key and Secret directly in the UI.
   - Click "Save Keys" to store them securely.

2. **File Upload**:
   - Go to the upload section of the application.
   - Select a file from your local machine and click "Upload".
   - The application will display a success message along with the IPFS hash.

3. **Viewing Uploaded Files**:
   - Navigate to the "Uploaded Files" section.
   - Here you can see all uploaded files along with their IPFS hashes and links.

## File Upload Process

The file upload process is straightforward:

1. Enter your API keys in the designated section of the UI.
2. Select a file using the file input field.
3. Click on the "Upload" button.
4. Upon successful upload, you will see a confirmation message with the IPFS hash.

## Viewing Uploaded Files

To view uploaded files:

1. Navigate to the "Uploaded Files" section.
2. You will see a list of files with their corresponding IPFS hashes.
3. Click on the link next to each hash to view it on IPFS using Pinata's gateway.

## Future Enhancements

- Implement user authentication for enhanced security.
- Add functionality to delete or manage previously uploaded files.
- Improve error handling for better user experience during uploads.

### What's New in the October 13, 2024 Update

#### 1. **Enhanced File Upload Details**
   - **SHA-256 Hash Storage**: Each uploaded file now includes a SHA-256 hash for improved verification and integrity checks.
   - **Upload Date Tracking**: The date and time of each file upload are now recorded, allowing users to see when files were added.

#### 2. **Social Media Sharing Functionality**
   - **Share Buttons Added**: Users can now easily share uploaded files on popular social media platforms, including:
     - **Facebook**
     - **Twitter**
     - **LinkedIn**
     - **WhatsApp**
   - **Iconify Integration**: Social share buttons feature icons from the Iconify library for a modern and visually appealing interface.

#### 3. **Added Tabs for Categorization**
   - **File Category Tabs**: The application now includes dedicated tabs for categorizing uploaded files, such as Images, Videos, Archives, and Software. This allows users to easily navigate and manage their files based on type.

#### 4. **Improved Pagination Logic**
   - **Category-Specific Pagination**: Pagination functionality has been enhanced to work seamlessly with different file categories, allowing users to navigate through their uploaded files easily.
   - **Current Category Detection**: The application now intelligently detects the current tab/category, ensuring that pagination works correctly for each section.
   
### What's New in the October 14, 2024 Update

#### 1. **Enhanced File Upload with Drag-and-Drop Support**

The addition of drag-and-drop functionality greatly improves the file upload process.

#### 2. **File Size Displayed in User Interface**

Easily view file sizes in the UI for quick access and better file management.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
