import time

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

def test_edit_place(driver, is_edit = True, is_delete = False, name=None, province=None,district=None,comune=None,address=None,desc=None):
    driver.get('http://localhost:9528/#/place/listing')
    time.sleep(2)

    driver.refresh()
    time.sleep(5)

    action_element = driver.find_elements(By.CSS_SELECTOR, 'tbody tr td button')
    if is_delete: 
        delete_element = action_element[1]
        driver.execute_script("arguments[0].click();", delete_element)
        return
    else: 
        edit_element = action_element[0]
        driver.execute_script("arguments[0].click();", edit_element)
        
    lst_input_elements = driver.find_elements(By.CSS_SELECTOR, "input[class*=el-input__inner]")
    lst_area_elements = driver.find_elements(By.CSS_SELECTOR, "textarea[class*=el-textarea__inner]")

    # assign value
    name_element = lst_input_elements[0]
    if name is not None:
        name_element.send_keys(name)

    province_element = lst_input_elements[1]
    if province is not None: 
        choose_dropdown_item(driver, province_element)
    
    time.sleep(1)
    
    district_element = lst_input_elements[2]
    if district is not None: 
        choose_dropdown_item(driver, district_element)

    time.sleep(1)
    
    commune_element = lst_input_elements[3]
    if comune is not None: 
        choose_dropdown_item(driver, commune_element)
    
    address_element = lst_area_elements[0]
    if address is not None: 
        address_element.send_keys(address)
    
    desc_element = lst_area_elements[1]
    if desc is not None: 
        desc_element.send_keys(desc)

    # click button
    time.sleep(1)
    driver.execute_script("window.scrollTo(0,document.body.scrollHeight);")

    button_element = driver.find_elements(By.CSS_SELECTOR, "div[class*=el-dialog__footer] button")
    edit_button_element = button_element[1]
    cancel_button_element = button_element[0]

    if is_edit:
        driver.execute_script("arguments[0].click();", edit_button_element)
    else:
        driver.execute_script("arguments[0].click();", cancel_button_element)

    time.sleep(2)
    text_class = driver.find_element(By.CSS_SELECTOR, "div[role=alert]").get_attribute('class')

    if is_edit:
        if "error" not in text_class:
            print("[Test case] OK")
        else: 
            print("[Test case] FAIL")
    else: # cancel
        if "warning" in text_class:
            print("[Test case] OK")
        else: 
            print("[Test case] FAIL")

driver = webdriver.Chrome()    
login(driver)

#QLDL_01
test_edit_place(driver, is_edit=True, is_delete=False,name=random_str(),province=True,district=True,comune=True,address=random_str(),desc=random_str())

#QLDL_02
test_edit_place(driver, is_edit=True, is_delete=True,name=random_str(),province=True,district=True,comune=True,address=random_str(),desc=random_str())

#QLDL_03
test_edit_place(driver, is_edit=True, is_delete=False,name=None,province=True,district=True,comune=True,address=random_str(),desc=random_str())

#QLDL_04
test_edit_place(driver, is_edit=True, is_delete=False,name=random_str(),province=None,district=True,comune=True,address=random_str(),desc=random_str())

#QLDL_05
test_edit_place(driver, is_edit=True, is_delete=False,name=random_str(),province=True,district=None,comune=True,address=random_str(),desc=random_str())

#QLDL_06
test_edit_place(driver, is_edit=True, is_delete=False,name=random_str(),province=True,district=True,comune=None,address=random_str(),desc=random_str())

#QLDL_07
test_edit_place(driver, is_edit=True, is_delete=False,name=random_str(),province=True,district=True,comune=True,address=None,desc=random_str())

#QLDL_08
test_edit_place(driver, is_edit=True, is_delete=False,name=random_str(),province=True,district=True,comune=True,address=random_str(),desc=None)