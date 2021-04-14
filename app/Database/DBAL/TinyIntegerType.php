<?php

namespace App\Database\DBAL;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TinyIntegerType extends Type
{
    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $name = $platform->getName();

        switch ($name) {
            case 'mysql':
            case 'mysql2':
                return $this->getMySqlPlatformSQLDeclaration($fieldDeclaration);

            default:
                throw new DBALException('Invalid platform: ' . $name);
        }
    }

    /**
     * Get the SQL declaration for MySQL.
     *
     * @param array $fieldDeclaration
     * @return string
     */
    protected function getMySqlPlatformSQLDeclaration(array $fieldDeclaration)
    {
        $columnType = 'TINYINT';

        if ($fieldDeclaration['precision']) {
            $columnType = 'TINYINT(' . $fieldDeclaration['precision'] . ')';
        }

        if ($fieldDeclaration['unsigned']) {
            $columnType .= '  UNSIGNED';
        }

        $notNull = $fieldDeclaration['notnull'] ?? false;

        if (!$notNull) {
            return $columnType . ' NULL';
        }

        return $columnType;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tinyinteger';
    }
}
