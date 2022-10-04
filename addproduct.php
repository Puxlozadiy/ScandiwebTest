<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/ProductList/header.css">
    <link rel="stylesheet" href="./css/AddProduct/main.css">
</head>
<body>
    <header>
        <h2>Product Add</h2>
        <div id="header-buttons">
            <label for="submit-product-add" class="header-button" onclick="submitForm()">Save</label>
            <input type="submit" value="" id="submit-product-add" style="display: none;">
            <a href="/" class="header-button">Cancel</a>
        </div>
    </header>
    <main>
        <form action="includes/API/add-product.php" method="post" id="product_form">
            <div id="static-inputs">
                <div class="input-container">
                    <label for="sku">SKU</label>
                    <input type="text" id="sku" name="sku">
                </div>
                <div class="input-container">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="input-container">
                    <label for="price">Price ($)</label>
                    <input type="number" id="price" name="price">
                </div>
            </div>
            <div id="type-switcher-container">
                <label for="">Type Switcher</label>
                <select name="type" id="productType">
                    <option value="DVD">DVD</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Book">Book</option>
                </select>
            </div>
            <div id="dynamic-inputs">
                <div id="dynamic-inputs-description">

                </div>
            </div>
        </form>
    </main>
    <script>
        var typeSwitcher = document.getElementById('productType')
        var dynamicInputs = document.getElementById('dynamic-inputs')
        var dynamicInputsDescription = document.getElementById('dynamic-inputs-description')
        var productTypes = [
            {
                name: "DVD",
                inputs: [
                    {
                        id: 'size',
                        label: 'Size (MB)',
                        name: 'size',
                        type: 'number'
                    }
                ],

                
            },
            {
                name: "Furniture",
                inputs: [
                    {
                        id: 'height',
                        label: 'Height (CM)',
                        name: 'height',
                        type: 'number'
                    },
                    {
                        id: 'width',
                        label: 'Width (CM)',
                        name: 'width',
                        type: 'number'
                    },
                    {
                        id: 'length',
                        label: 'Length (CM)',
                        name: 'length',
                        type: 'number'
                    }
                ]
            },
            {
                name: "Book",
                inputs: [
                    {
                        id: 'weight',
                        label: 'Weight (KG)',
                        name: 'weight',
                        type: 'number'
                    }
                ]
            }
        ]

        var addInput = (input, inputs) => {
            var newContainer = document.createElement('div')
            newContainer.className = 'input-container dynamic'
            var newLabel = document.createElement('label')
            newLabel.innerHTML = input.label
            var newInput = document.createElement('input')
            newInput.id = input.id
            newInput.name = input.name
            newInput.type = input.type
            newInput.addEventListener('input', (event) => {
                checkInputFields(inputs)
            })
            newContainer.appendChild(newLabel)
            newContainer.appendChild(newInput)
            dynamicInputs.prepend(newContainer)
        }

        var checkInputFields = (inputs) => {
            var missFounded = false
            inputs.reverse().map(input => {
                if(!missFounded){
                    targetInput = document.getElementById(input.id)
                    if(targetInput.value.length === 0){
                        dynamicInputsDescription.innerHTML = `Please, provide ${input.id}`
                        missFounded = true
                    }
                }
            })
            if(!missFounded){
                dynamicInputsDescription.innerHTML = ''
            }
        }

        var initializeDynamicInputs = () => {
            Array.from(dynamicInputs.getElementsByClassName('input-container')).forEach(el => {
                el.remove()
            });
            productTypes[0].inputs.reverse().map(input => {
                addInput(input, productTypes[0].inputs)
            })
            checkInputFields(productTypes[0].inputs)
        }
        initializeDynamicInputs()
        

        typeSwitcher.addEventListener('change', (event) => {
            productTypes.map(type => {
                if(type.name === event.target.value){
                    Array.from(dynamicInputs.getElementsByClassName('input-container')).forEach(el => {
                        el.remove()
                    });
                    type.inputs.reverse().map(input => {
                        addInput(input, type.inputs)
                    })
                    checkInputFields(type.inputs)
                }
            })
        })

        var submitForm = () => {
            var skuInput = document.getElementById('sku')
            var nameInput = document.getElementById('name')
            var priceInput = document.getElementById('price')
            var typeInput = document.getElementById('productType')

            var formInputs = document.getElementById('product_form').getElementsByTagName('input')
            for (let input of formInputs) {
                if(input.value.length === 0) {
                    alert('Please, submit required data')
                    return
                }
            }
            document.getElementById('product_form').submit()
        }

        
    </script>
</body>
</html>