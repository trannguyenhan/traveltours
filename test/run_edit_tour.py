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

def test_edit_tour(driver, is_create = True, is_delete=False, name=None, category=None, range=None, max_slot=None, hotel_star=None, vehicle=None, 
                  start_date=None, schedule=None, place=None, adult_price=None, child_price=None, tour_guide=None):
    driver.get('http://localhost:9528/#/tour/listing')
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

    # assign value
    name_element = lst_input_elements[0]
    if name is not None:
        name_element.send_keys(name)

    category_element = lst_input_elements[1]
    if category is not None: 
        choose_dropdown_item(driver, category_element)

    range_element = lst_input_elements[2]
    if range is not None:
        range_element.send_keys(range)

    schedule_element = lst_input_elements[3]
    if schedule is not None: 
        schedule_element.send_keys(schedule)

    max_slot_element = lst_input_elements[4]
    if max_slot is not None:
        max_slot_element.send_keys(max_slot)

    hotel_star_element = lst_input_elements[5]
    if hotel_star is not None:
        hotel_star_element.send_keys(hotel_star)

    adult_price_value_element = lst_input_elements[6]
    if adult_price is not None:
        adult_price_value_element.send_keys(adult_price)

    child_price_value_element = lst_input_elements[7]
    if child_price is not None: 
        child_price_value_element.send_keys(child_price)

    vehicle_element = lst_input_elements[8]
    if vehicle is not None:
        vehicle_element.send_keys(vehicle)

    start_date_element = lst_input_elements[9]
    if start_date is not None:
        start_date_element.send_keys(start_date)

    place_element = lst_input_elements[10]
    if place is not None: 
        choose_dropdown_item(driver, place_element)

    tour_guide_element = lst_input_elements[11]
    if tour_guide is not None: 
        choose_dropdown_item(driver, tour_guide_element)

    # click button
    time.sleep(1)
    driver.execute_script("window.scrollTo(0,document.body.scrollHeight);")

    button_element = driver.find_elements(By.CSS_SELECTOR, "div[class*=el-dialog__footer] button")
    create_button_element = button_element[0]
    cancel_button_element = button_element[1]

    if is_create:
        driver.execute_script("arguments[0].click();", create_button_element)
    else:
        driver.execute_script("arguments[0].click();", cancel_button_element)

    time.sleep(2)

    try:
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
    except:
        print("[Test case] OK")

driver = webdriver.Chrome()    
login(driver)

# TCDL_01
test_edit_tour(driver, is_create=True,name=random_str(),start_date='12/12/2023',adult_price=random_num(),child_price=random_num(),tour_guide=True)
# TCDL_02
test_edit_tour(driver, is_create=False,name=random_str(),category=True,range=random_num(),max_slot=random_num(),
              hotel_star=random_num(),vehicle=random_str(),start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_03
test_edit_tour(driver, is_create=True,name='3',category=True,range=random_num(),max_slot=random_num(),
              hotel_star=random_num(),vehicle=random_str(),start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_04
test_edit_tour(driver, is_create=True,name=None,category=True,range=random_num(),max_slot=random_num(),
              hotel_star=random_num(),vehicle=random_str(),start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_05
test_edit_tour(driver, is_create=True,name=random_str(),category=None,range=random_num(),max_slot=random_num(),
              hotel_star=random_num(),vehicle=random_str(),start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_06
test_edit_tour(driver, is_create=True,name=random_str(),category=True,range=None,max_slot=random_num(),
              hotel_star=random_num(),vehicle=random_str(),start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_07
test_edit_tour(driver, is_create=True,name=random_str(),category=True,range=random_num(),max_slot=None,
              hotel_star=random_num(),vehicle=random_str(),start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_08
test_edit_tour(driver, is_create=True,name=random_str(),category=True,range=random_num(),max_slot=random_num(),
              hotel_star=None,vehicle=random_str(),start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_09
test_edit_tour(driver, is_create=True,name=random_str(),category=True,range=random_num(),max_slot=random_num(),
              hotel_star=random_num(),vehicle=None,start_date='12/12/2023',schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)
# TCDL_10
test_edit_tour(driver, is_create=True,name=random_str(),category=True,range=random_num(),max_slot=random_num(),
              hotel_star=random_num(),vehicle=random_str(),start_date=None,schedule=random_str(),adult_price=random_num(),
              child_price=random_num(),tour_guide=True)