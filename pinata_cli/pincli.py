# pinata_cli.py

import os
import json
import requests
import inquirer
import webbrowser

PINATA_API_URL = "https://api.pinata.cloud/pinning/pinFileToIPFS"
PINATA_API_KEY_FILE = "pinata_keys.json"
UPLOADED_FILES_FILE = "uploaded_files.json"

def load_api_keys():
    if os.path.exists(PINATA_API_KEY_FILE):
        with open(PINATA_API_KEY_FILE, "r") as f:
            return json.load(f)
    return None

def save_api_keys(api_key, api_secret):
    with open(PINATA_API_KEY_FILE, "w") as f:
        json.dump({"api_key": api_key, "api_secret": api_secret}, f)
    print("API keys saved successfully!")

def load_uploaded_files():
    if os.path.exists(UPLOADED_FILES_FILE):
        with open(UPLOADED_FILES_FILE, "r") as f:
            return json.load(f)
    return []

def save_uploaded_file(ipfs_hash):
    uploaded_files = load_uploaded_files()
    uploaded_files.append({
        "ipfs_hash": ipfs_hash,
        "link": f"https://gateway.pinata.cloud/ipfs/{ipfs_hash}"
    })
    
    with open(UPLOADED_FILES_FILE, "w") as f:
        json.dump(uploaded_files, f)

def upload_file(api_key, api_secret):
    file_path = input("Enter the path of the file to upload: ")
    
    if not os.path.isfile(file_path):
        print("File does not exist.")
        return
    
    with open(file_path, "rb") as file:
        response = requests.post(
            PINATA_API_URL,
            files={"file": file},
            headers={
                "pinata_api_key": api_key,
                "pinata_secret_api_key": api_secret,
            }
        )
    
    if response.status_code == 200:
        ipfs_hash = response.json()['IpfsHash']
        print(f"File uploaded successfully! IPFS Hash: {ipfs_hash}")
        
        # Save the uploaded file's hash and link
        save_uploaded_file(ipfs_hash)

        # Ask if the user wants to open the link in a browser
        open_link = input("Do you want to open the link in your browser? (yes/no): ").strip().lower()
        if open_link == 'yes':
            webbrowser.open(f"https://gateway.pinata.cloud/ipfs/{ipfs_hash}")
    else:
        print(f"Error uploading file: {response.text}")

def view_uploaded_files():
    uploaded_files = load_uploaded_files()
    
    if not uploaded_files:
        print("No files have been uploaded yet.")
        return
    
    print("\nUploaded Files:")
    for file in uploaded_files:
        print(f"- IPFS Hash: {file['ipfs_hash']}, Link: {file['link']}")

def main_menu():
    keys = load_api_keys()
    
    if keys:
        api_key = keys['api_key']
        api_secret = keys['api_secret']
    else:
        api_key = api_secret = None

    while True:
        questions = [
            inquirer.List(
                'action',
                message="Select an action:",
                choices=['Save API Keys', 'Upload File', 'View Uploaded Files', 'Exit'],
            ),
        ]
        
        answers = inquirer.prompt(questions)

        if answers['action'] == 'Save API Keys':
            api_key = input("Enter your Pinata API Key: ")
            api_secret = input("Enter your Pinata API Secret: ")
            save_api_keys(api_key, api_secret)
        
        elif answers['action'] == 'Upload File':
            if not api_key or not api_secret:
                print("Please save your API keys first.")
            else:
                upload_file(api_key, api_secret)
        
        elif answers['action'] == 'View Uploaded Files':
            view_uploaded_files()
        
        elif answers['action'] == 'Exit':
            print("Exiting...")
            break

if __name__ == "__main__":
    main_menu()