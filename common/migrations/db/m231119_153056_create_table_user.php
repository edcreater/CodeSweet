<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user}}`.
 */
class m231119_153056_create_table_user extends Migration
{

    /** @var string  */
    protected $user = '{{%user}}';
    protected $userToken = '{{%user_token}}';
    protected $userProfile = '{{%user_profile}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->userToken, [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'type' => $this->string(255)->notNull(),
            'token' => $this->string(40)->notNull(),
            'expire_at' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $collation);

        $this->createTable($this->userProfile, [
            'user_id' => $this->primaryKey()->notNull(),
            'firstname' => $this->string(255),
            'middlename' => $this->string(255),
            'lastname' => $this->string(255),
            'avatar_path' => $this->string(255),
            'avatar_base_url' => $this->string(255),
            'locale' => $this->string(32)->notNull(),
            'gender' => $this->smallInteger(1),
        ], $collation);

        $this->createTable($this->user, [
            'id' => $this->primaryKey()->notNull(),
            'username' => $this->string(32),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(40)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'oauth_client' => $this->string(255),
            'oauth_client_user_id' => $this->string(255),
            'email' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(2),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'logged_at' => $this->integer(11),
        ], $collation);

        /**
         * Create foreign keys for table user_profile
         */
         // add foreign key for table `user`
         $this->addForeignKey(
             'fk_user',
             $this->userProfile,
             'user_id',
             '{{%user}}',
             'id',
             'cascade',
             'cascade'
         );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        /**
         * Remove keys for table user_profile
         */

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk_user',
            '{{%user}}'
        );

        /**
         * Drop tables
         */

        $this->dropTable($this->user);
        $this->dropTable($this->userProfile);
        $this->dropTable($this->userToken);
    }
}
