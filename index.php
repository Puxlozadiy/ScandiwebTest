<?php
include './includes/classes/products.class.php';
$products = new Products();
$productList = $products->fetch_all_products();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/ProductList/header.css">
    <link rel="stylesheet" href="./css/ProductList/main.css">
</head>
<body>
    <header>
        <h2>Product List</h2>
        <div id="header-buttons">
            <a href="/addproduct.php" class="header-button">ADD</a>
            <a href="/includes/API/mass-delete.php?ids=" class="header-button" id="delete-product-btn">MASS DELETE</a>
        </div>
    </header>
    <main>
        <div id="products">
            
        </div>
    </main>

    <script>
        var productsToDelete = []
        var products = <?php echo json_encode($productList); ?>;
        var productsGrid = document.getElementById('products')
        products.map(product => {
            var productCard = document.createElement('div')
            var deleteCheckbox = document.createElement('input')
            deleteCheckbox.type = 'checkbox'
            deleteCheckbox.className = 'delete-checkbox'
            deleteCheckbox.id = `product-${product["ID"]}`
            deleteCheckbox.addEventListener('change', (event) => {
                if(event.target.checked){
                    productsToDelete.push(event.target.id.substring(8))
                } else{
                    productsToDelete = productsToDelete.filter(value => value !== event.target.id.substring(8))
                }
                document.getElementById('delete-product-btn').href = `/includes/API/mass-delete.php?ids=${productsToDelete.map(productId => {return `${productId}`})}`
            })
            productCard.className = 'product'
            productCard.innerHTML = `
            <span>${product['SKU']}</span>
            <span>${product["ID"]}</span>
            <span>${product["Name"]}</span>
            <span>${product["Type"]}</span>
            `
            switch(product["Type"]){
                case "DVD":
                    productCard.innerHTML = productCard.innerHTML + `
                        <span>Size: ${product["Size"]} MB</span>
                    `
                    break
                case "Furniture":
                    productCard.innerHTML = productCard.innerHTML + `
                        <span>Width: ${product["Width"]} CM</span>
                        <span>Height: ${product["Height"]} CM</span>
                        <span>Length: ${product["Length"]} CM</span>
                    `
                    break
                case "Book":
                    productCard.innerHTML = productCard.innerHTML + `
                        <span>Weight: ${product["Weight"]} KG</span>
                    `
                    break
            }
            productCard.appendChild(deleteCheckbox)
            productsGrid.appendChild(productCard)
        })
    </script>
</body>
</html>