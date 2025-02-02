/*
  +----------------------------------------------------------------------+
  | pthreads                                                             |
  +----------------------------------------------------------------------+
  | Copyright (c) Joe Watkins 2012 - 2015                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author: Joe Watkins <krakjoe@php.net>                                |
  +----------------------------------------------------------------------+
 */
#ifndef HAVE_PTHREADS_OBJECT_H
#define HAVE_PTHREADS_OBJECT_H

#ifdef HAVE_CONFIG_H
#	include <config.h>
#endif

#include <src/pthreads.h>

/* {{{ */
zend_object* pthreads_threaded_base_ctor(zend_class_entry *entry);
zend_object* pthreads_threaded_array_ctor(zend_class_entry *entry);
zend_object* pthreads_worker_ctor(zend_class_entry *entry);
zend_object* pthreads_thread_ctor(zend_class_entry *entry);
void         pthreads_base_dtor(zend_object *object);
void         pthreads_base_free(zend_object *object);
HashTable*   pthreads_base_gc(zend_object *object, zval **table, int *n);
/* }}} */

/* {{{ */
int pthreads_threaded_unserialize(zval *object, zend_class_entry *ce, const unsigned char *buffer, size_t buflen, zend_unserialize_data *data);
int pthreads_threaded_serialize(zval *object, unsigned char **buffer, size_t *buflen, zend_serialize_data *data); /* }}} */

/* {{{ */
void pthreads_current_thread(zval *return_value); /* }}} */

/* {{{ */
zend_bool pthreads_start(pthreads_zend_object_t* thread, zend_ulong thread_options);
zend_bool pthreads_join(pthreads_zend_object_t* thread); /* }}} */

/* {{{ */
int pthreads_connect(pthreads_zend_object_t* source, pthreads_zend_object_t* destination); /* }}} */

/* {{{ */
zend_bool pthreads_globals_object_connect(pthreads_zend_object_t* address, zend_class_entry *ce, zval *object); /* }}} */

/* {{{ */
zend_object_iterator* pthreads_object_iterator_create(zend_class_entry *ce, zval *object, int by_ref); /* }}} */

/* {{{ */
#ifndef HAVE_PTHREADS_HANDLERS_H
#	include <src/handlers.h>
#endif /* }}} */

#endif /* HAVE_PTHREADS_OBJECT_H */
