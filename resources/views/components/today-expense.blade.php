<div class="expenses">
    <div class="cell bg-brandPrimary cells-header border-2 border-black">
        Expenses / Movimentos
    </div>
    <form class="flex" action="" method="post">
        <div class="expense qty">
            <div class="cell bg-brandPrimary border-x-2 border-black">
                QTY
            </div>
            <input class="cell w-full border-2 border-black bg-gray-400 text-black" name="expense_qty" type="number" value="1" />
        </div>
        <div class="expense item">
            <div class="cell bg-brandPrimary border-r-2 border-black">
                ITEM
            </div>
            <select class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="expense-item" id="">
                <option value="">SALARIES</option>
                <option value="">RENT</option>
            </select>
        </div>
        <div class="expense price">
            <div class="cell bg-brandPrimary border-r-2 border-black">
                U. Price
            </div>
            <input class="cell w-full border-2 border-l-0 border-black bg-gray-400 text-black" name="" type="number" />
        </div>
        <div class="expense submit">
            <input class="m-2 rounded-xl bg-blue-700 px-4 py-1 font-semibold" type="submit" value="Save" />
        </div>
    </form>
</div>