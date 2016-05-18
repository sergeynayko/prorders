<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tables`.
 */
class m160517_080459_create_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('departaments', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
        ]);
		
		$this->createTable('employees', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'departamentId' => $this->integer()->notNull(),
        ]);
		
		$this->addForeignKey('FK_departamentEmpl', 'employees', 'departamentId', 'departaments', 'id', 'RESTRICT', 'RESTRICT');
		
		$this->createTable('products', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'code' => $this->string()->notNull(),
			'price' => $this->decimal(15,2)->defaultValue(0),
		]);
		
		$this->createTable('operations', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'departamentId' => $this->integer()->notNull(),
			'defaultOp' => $this->boolean()->defaultValue(false),
		]);
		
		$this->addForeignKey('FK_departamentOper', 'operations', 'departamentId', 'departaments', 'id', 'RESTRICT', 'RESTRICT');
		
		$this->createTable('specifications', [
            'id' => $this->primaryKey(),
			'date' => $this->date()->notNull(),
			'operationId' => $this->integer()->notNull(),
			'productId' => $this->integer()->notNull(),
			'rate' => $this->decimal(15,2)->notNull(),
			'sequence' => $this->integer()->notNull(),
			'duration' => $this->integer()->notNull(),
		]);	
		
		$this->addForeignKey('FK_specificationsOper', 'specifications', 'operationId', 'operations', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_specificationsProd', 'specifications', 'productId', 'products', 'id', 'RESTRICT', 'RESTRICT');
		
		$this->createTable('orders', [
            'id' => $this->primaryKey(),
			'date' => $this->date()->notNull(),
			'invoiceNo' => $this->string()->notNull(),
			'beginDate' => $this->date()->notNull(),
			'endDate' => $this->date()->notNull(),
			'productId' => $this->integer()->notNull(),
			'quantity' => $this->integer()->notNull(),
			'status' => $this->string(),
		]);	

		$this->addForeignKey('FK_ordersProd', 'orders', 'productId', 'products', 'id', 'RESTRICT', 'RESTRICT');
		
		$this->createTable('orderDetails', [
            'id' => $this->primaryKey(),
			'orderId' => $this->integer()->notNull(),
			'operationId' => $this->integer()->notNull(),
			'employeeId' => $this->integer()->notNull(),
			'quantity' => $this->integer()->notNull(),
			'rate' => $this->decimal(15,2)->notNull(),
			'sum' => $this->decimal(15,2)->notNull(),
			'executionDate' => $this->date()->notNull(),
		]);	
		
		$this->addForeignKey('FK_orderDetailsOrder', 'orderDetails', 'orderId', 'orders', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_orderDetailsOper', 'orderDetails', 'operationId', 'operations', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_orderDetailsEmpl', 'orderDetails', 'employeeId', 'employees', 'id', 'RESTRICT', 'RESTRICT');
		
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
		$this->dropTable('orderDetails');
		$this->dropTable('orders');
		$this->dropTable('specifications');
		$this->dropTable('operations');
		$this->dropTable('products');
		$this->dropTable('employees');
		$this->dropTable('departaments');
    }
}
