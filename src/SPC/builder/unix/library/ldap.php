<?php

declare(strict_types=1);

namespace SPC\builder\unix\library;

trait ldap
{
    protected function build(): void
    {
        $alt = '';
        // openssl support
        $alt .= $this->builder->getLib('openssl') && $this->builder->getExt('zlib') ? '--with-tls=openssl ' : '';
        // gmp support
        $alt .= $this->builder->getLib('gmp') ? '--with-mp=gmp ' : '';
        // libsodium support
        $alt .= $this->builder->getLib('libsodium') ? '--with-argon2=libsodium ' : '';
        shell()->cd($this->source_dir)
            ->exec(
                $this->builder->configure_env . ' ' .
                $this->builder->makeAutoconfFlags(AUTOCONF_LDFLAGS | AUTOCONF_CPPFLAGS) .
                ' ./configure ' .
                '--enable-static ' .
                '--disable-shared ' .
                '--disable-slapd ' .
                '--disable-slurpd ' .
                '--without-systemd ' .
                '--without-cyrus-sasl ' .
                $alt .
                '--prefix='
            )
            ->exec('make clean')
            // remove tests and doc to prevent compile failed with error: soelim not found
            ->exec('sed -i -e "s/SUBDIRS= include libraries clients servers tests doc/SUBDIRS= include libraries clients servers/g" Makefile')
            ->exec("make -j{$this->builder->concurrency}")
            ->exec('make install DESTDIR=' . BUILD_ROOT_PATH);
        $this->patchPkgconfPrefix(['ldap.pc', 'lber.pc']);
    }
}
