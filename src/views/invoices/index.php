<style>
    table{
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    table tr th, table tr td {
        border: 1px #eee solid;
        padding: 5px;
    }
    .color-green {
        color: green;
    }

    .color-red {
        color: red;
    }

    .color-gray {
        color: gray;
    }

    .color-orange {
        color: orange;
    }
</style>
<table>
    <thead>
        <tr>
            <th>Invoice #</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invoices as $invoice): ?>
        <pre>
            <?php print_r($invoice); ?>
        </pre>
            <tr>
                    <td><?php echo $invoice['id'] ?> </td>
                    <td><?php echo number_format($invoice['amount'], 2) ?> </td>
                    <td class="color-<?= App\Enums\InvoiceStatus::tryFrom($invoice['status'])->color()->value  ?>">
                        <?php echo App\Enums\InvoiceStatus::tryFrom($invoice['status'])->toString(); ?>
                    </td>

            </tr>


        <?php endforeach; ?>
    </tbody>
</table>