<?=template_header('Order Confirmation')?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .placeorder {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
    }

    h1 {
        color: #28a745;
    }

    p {
        font-size: 1.2em;
        color: #333;
    }

    .content-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
</style>

<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us! We'll contact you by email with your order details.</p>
</div>

<?=template_footer()?>
