<?php

namespace App\Infrastructure\Database;

use App\Domain\Entity\EntityInterface;
use App\Infrastructure\Database\Exception\FailedToResolveEntityClassException;
use App\Infrastructure\Database\Exception\IllegalTypeOfInstanceDetectedException;
use App\Interfaces\Gateway\Database\HandlerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Eloquent;

class MysqlHandler implements HandlerInterface
{
    /**
     * MysqlHandler constructor.
     */
    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => MYSQL_HOST,
            'port'      => MYSQL_PORT,
            'database'  => MYSQL_DB_NAME,
            'username'  => MYSQL_USER,
            'password'  => MYSQL_PASS,
            'charset'   => MYSQL_CHARSET,
            'collation' => MYSQL_COLLATION
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     * @param string $entityClass
     * @param int $id
     * @return \ArrayObject
     */
    public function findById(string $entityClass, int $id): \ArrayObject
    {
        if (!class_exists($entityClass)) {
            throw new FailedToResolveEntityClassException();
        }

        $interfaces = class_implements($entityClass);
        if (!isset($interfaces[EntityInterface::class])) {
            throw new IllegalTypeOfInstanceDetectedException();
        }

        $model = new class extends Eloquent {};

        $model->setTable($entityClass::table());
        $model->fillable($entityClass::fillable());

        $result = $model->find($id);

        return $result ? new \ArrayObject($result->toArray()) : new \ArrayObject();
    }
}
