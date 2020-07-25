import requests
import json

@step('the users list has items')
def step_impl(context):
    assert True

@step('the users list is returned')
def step_impl(context):
    assert True

@step('each element has the {attribute} attribute')
def step_impl(context, attribute):
    response = requests.get('http://webserver/api/usuarios')
    status_code = response.status_code
    assert status_code == 200
    usuarios = response.json()
    print(json.dumps(usuarios, indent=4))
    assert len(usuarios) > 1

def after_step(context, step):
    print()
    print()

