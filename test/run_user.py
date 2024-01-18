import time

from selenium.webdriver.chrome.options import Options
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

def random_str():
    return "asdf"

def random_num():
    return 12

def login(driver):
    driver.get('http://localhost:9528/#/login?redirect=%2Fdashboard')
    username_element = driver.find_element(By.CSS_SELECTOR, "input[name=username]")
    username_element.send_keys("admin123")

    password_element = driver.find_element(By.CSS_SELECTOR, "input[name=password]")
    password_element.send_keys("123456")
    
    time.sleep(3)

    button = driver.find_element(By.CSS_SELECTOR, "form button[type=button]")
    button.send_keys(Keys.ENTER)

    time.sleep(5)

def choose_dropdown_item(driver, element):
    # open dropdown list
    driver.execute_script("arguments[0].click();", element)
    
    # click random item
    dropdown_lst_input_elements = driver.find_elements(By.CSS_SELECTOR, "ul[class*='scrollbar__view el-select-dropdown__list']")
    for dropdown_list_element in dropdown_lst_input_elements:
        try:
            li_element = dropdown_list_element.find_element(By.CSS_SELECTOR, 'li')
            driver.execute_script("arguments[0].click();", li_element)
        except:
            pass

    # close dropdown list
    driver.execute_script("arguments[0].click();", element)

def test_add_place(driver, is_create = True, name=None, username=None,email=None,password=None):
    driver.get('http://localhost:9528/#/user/add')
    time.sleep(2)

    driver.refresh()
    time.sleep(5)

    lst_input_elements = driver.find_elements(By.CSS_SELECTOR, "input[class*=el-input__inner]")

    # assign value
    name_element = lst_input_elements[0]
    if name is not None:
        name_element.send_keys(name)

    username_element = lst_input_elements[1]
    if username is not None:
        username_element.send_keys(username)

    email_element = lst_input_elements[2]
    if email is not None:
        email_element.send_keys(email)

    password_element = lst_input_elements[3]
    if password is not None:
        password_element.send_keys(password)

    # click button
    time.sleep(1)
    driver.execute_script("window.scrollTo(0,document.body.scrollHeight);")

    button_element = driver.find_elements(By.CSS_SELECTOR, "div[class*=el-form-item__content] button")
    create_button_element = button_element[0]
    cancel_button_element = button_element[1]

    if is_create:
        driver.execute_script("arguments[0].click();", create_button_element)
    else:
        driver.execute_script("arguments[0].click();", cancel_button_element)

    time.sleep(2)
    text_class = driver.find_element(By.CSS_SELECTOR, "div[role=alert]").get_attribute('class')

    if is_create:
        if "error" not in text_class:
            print("[Test case] OK")
        else: 
            print("[Test case] FAIL")
    else: # cancel
        if "warning" in text_class:
            print("[Test case] OK")
        else: 
            print("[Test case] FAIL")

options = Options()
options.add_argument('--headless=new')
driver = webdriver.Chrome(options=options)    
login(driver)

#TND_01
test_add_place(driver=driver,is_create=True,name=random_str(),username=random_str(),email=random_str(),password=random_str())

#TND_02
test_add_place(driver=driver,is_create=True,name=None,username=random_str(),email=random_str(),password=random_str())

#TND_03
test_add_place(driver=driver,is_create=True,name=random_str(),username=None,email=random_str(),password=random_str())

#TND_04
test_add_place(driver=driver,is_create=True,name=random_str(),username=random_str(),email=None,password=random_str())

#TND_05
test_add_place(driver=driver,is_create=True,name=random_str(),username=random_str(),email=random_str(),password=None)