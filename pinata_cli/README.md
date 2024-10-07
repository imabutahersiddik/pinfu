# Pincli

A simple command-line interface (CLI) application for uploading files to Pinata, managing API keys, and viewing uploaded files. This application allows users to interact with the Pinata API directly from the terminal.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Commands](#commands)
- [Examples](#examples)
- [Future Enhancements](#future-enhancements)
- [License](#license)

## Features

- Save your Pinata API keys securely.
- Upload files to Pinata and receive the IPFS hash.
- View links to uploaded files.
- Option to open uploaded file links in a web browser.

## Requirements

- Python 3.x
- `requests` library
- `inquirer` library

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/imabutahersiddik/pinfu.git
   cd pinfu && pincli
   ```

2. **Create a virtual environment** (optional but recommended):
   ```bash
   python -m venv venv
   source venv/bin/activate  # On Windows use `venv\Scripts\activate`
   ```

3. **Install required packages**:
   ```bash
   pip install requests inquirer
   ```

## Usage

1. **Run the application**:
   ```bash
   python pinata_cli.py
   ```

2. **Follow the prompts** to save your API keys, upload files, or view uploaded files.

## Commands

The CLI provides the following options:

1. **Save API Keys**: Enter your Pinata API Key and Secret to save them for future use.
2. **Upload File**: Enter the path of the file you want to upload to Pinata.
3. **View Uploaded Files**: List all uploaded files along with their IPFS hashes and links.
4. **Exit**: Exit the application.

## Examples

### Saving API Keys

When prompted, enter your Pinata API Key and Secret:

```
Select an action:
? Select an action: (Use arrow keys)
  Save API Keys
  Upload File
  View Uploaded Files
  Exit
```

### Uploading a File

After selecting "Upload File", enter the path to the file you wish to upload:

```
Enter the path of the file to upload: /path/to/your/file.txt
File uploaded successfully! IPFS Hash: QmExampleHash1234567890
Do you want to open the link in your browser? (yes/no): yes
```

### Viewing Uploaded Files

When you select "View Uploaded Files", you'll see a list of all uploaded files:

```
Uploaded Files:
- IPFS Hash: QmExampleHash1234567890, Link: https://gateway.pinata.cloud/ipfs/QmExampleHash1234567890
```

## Future Enhancements

- Implement error handling for network issues or invalid API responses.
- Add functionality to delete or manage previously uploaded files.
- Enhance user experience with better input validation.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.