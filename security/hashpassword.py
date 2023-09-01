import hashlib
import os
import base64
import sys

def main(password):
    if not password:
        sys.stderr.write("Nothing to do.\n")
        sys.exit(1)
    
    # Generate a random salt
    salt = os.urandom(32)
    
    # Hash the password with the salt
    hash_obj = hashlib.sha256()
    hash_obj.update(salt)
    hash_obj.update(password.encode('utf-8'))
    bt_pass = hash_obj.digest()
    bt_pass = hashlib.sha256(bt_pass).digest()
    
    print(base64.b64encode(bt_pass).decode() + " " + base64.b64encode(salt).decode())
    sys.exit(0)

if __name__ == '__main__':
    if len(sys.argv) != 2:
        sys.stderr.write("Usage: python solr_password_hash.py <password>\n")
        sys.exit(1)
    main(sys.argv[1])
