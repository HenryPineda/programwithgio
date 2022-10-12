<h1>Home Page</h1>
<h1><?php echo $foo ?></h1>
<form action="/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="transactions" />
    <button type="submit">Upload transactions</button>
</form>
<a href="/download">My File<button>Donwload File</button></a>
<hr />
<?php if(!empty($invoice)): ?>
Invoice Id: <?= $invoice['invoice_id'] ?>
    Invoice Amount: <?= $invoice['amount'] ?>
    User Name: <?= $invoice['full_name'] ?>

<?php endif ?>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Check</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($transactions)): ?>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
<!--                <td>--><?php //echo formatDate($transaction['date']); ?><!--</td>-->
                <td><?php echo $transaction['date']; ?></td>
                <td><?php echo $transaction['checkNumber']; ?></td>
                <td><?php echo $transaction['description']; ?></td>
                <td>

                    <?php if ($transaction['amount'] > 0): ?>
<!--                    <span style="color:green">--><?php //echo formatNumber($transaction['amount']); ?><!--</td>-->
                    <span style="color:green"><?php echo $transaction['amount']; ?></td>
                </span>
                <?php elseif ($transaction['amount'] < 0): ?>
<!--                    <span style="color:red">--><?php //echo formatNumber($transaction['amount']); ?><!--</td></span>-->
                    <span style="color:red"><?php echo $transaction['amount']; ?></td></span>
                <?php else: ?>
<!--                    <span>--><?php //echo formatNumber($transaction['amount']); ?><!--</td></span>-->
                    <span><?php echo $transaction['amount']; ?></td></span>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
<!--    <tfoot>-->
<!--    <tr>-->
<!--        <th colspan="3">Total Income:</th>-->
<!--        <td>--><?php //echo formatNumber($totals['totalIncome']); ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <th colspan="3">Total Expense:</th>-->
<!--        <td>--><?php //echo formatNumber($totals['totalExpense']); ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <th colspan="3">Net Total:</th>-->
<!--        <td>--><?php //echo formatNumber($totals['totals']); ?><!--</td>-->
<!--    </tr>-->
<!--    </tfoot>-->
</table>
