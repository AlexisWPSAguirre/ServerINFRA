PGDMP         !                z         
   inf_contra    14.1    14.1 (    ,           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            -           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            .           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            /           1262    20380 
   inf_contra    DATABASE     i   CREATE DATABASE inf_contra WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Colombia.1252';
    DROP DATABASE inf_contra;
                postgres    false            �            1259    20396    certificado_disponibilidad    TABLE     �   CREATE TABLE public.certificado_disponibilidad (
    id integer NOT NULL,
    rubro character varying,
    valor character varying,
    fuente_recursos character varying,
    anticipo character varying
);
 .   DROP TABLE public.certificado_disponibilidad;
       public         heap    postgres    false            �            1259    20406    contratista    TABLE     v   CREATE TABLE public.contratista (
    id integer NOT NULL,
    nombre character varying,
    nit character varying
);
    DROP TABLE public.contratista;
       public         heap    postgres    false            �            1259    20386    contrato    TABLE     q  CREATE TABLE public.contrato (
    no_contrato character varying,
    id integer NOT NULL,
    fecha_firma date,
    f_aprob_polizas date,
    valor_contrato character varying,
    no_proyecto_fk integer,
    no_certificado integer,
    fecha_certificado date,
    registro_id integer,
    no_presupuestal character varying,
    fecha_presupuestal character varying
);
    DROP TABLE public.contrato;
       public         heap    postgres    false            �            1259    20456    coordenadas    TABLE     3  CREATE TABLE public.coordenadas (
    id integer NOT NULL,
    coo_proyecto_id integer,
    latitud character varying,
    longitud character varying,
    latitud_inicial character varying,
    latitud_final character varying,
    longitud_inicial character varying,
    longitud_final character varying
);
    DROP TABLE public.coordenadas;
       public         heap    postgres    false            �            1259    20471    hitos    TABLE     �   CREATE TABLE public.hitos (
    id integer NOT NULL,
    hito character varying,
    fecha_inicio date,
    detalle_hito character varying,
    valor_adiciones_hito character varying,
    dias_hito integer,
    proyecto_id integer
);
    DROP TABLE public.hitos;
       public         heap    postgres    false            �            1259    20481    obras    TABLE     �  CREATE TABLE public.obras (
    id integer NOT NULL,
    sector character varying,
    municipio_obra character varying,
    departamento_obra character varying,
    codigo_divipola_municipio integer,
    unidad_funcional_acuerdo_obra character varying,
    fecha_inicial_terminacion date,
    fecha_final_terminacion date,
    avance_fisico_inicial "char",
    avance_fisico_ejecutado "char",
    avance_financiero_ejecutado "char",
    cantidad_suspensiones "char",
    cantidad_prorrogas "char",
    tiempo_suspensiones "char",
    tiempo_prorrogas "char",
    cantidad_adiciones "char",
    valor_total_adiciones "char",
    origen_recursos "char",
    valor_comprometido "char",
    valor_obligado "char",
    valor_pagado "char",
    valor_anticipo "char",
    latitud_inicial "char",
    latitud_final "char",
    longitud_final "char",
    estado "char",
    cesion "char",
    nuevo_contratista "char",
    observaciones "char",
    link_secop "char",
    proyecto_id integer,
    coordenadas_id integer
);
    DROP TABLE public.obras;
       public         heap    postgres    false            �            1259    20381    proyecto    TABLE     :  CREATE TABLE public.proyecto (
    id integer NOT NULL,
    no_proyecto character varying,
    proceso character varying,
    fecha_iniciacion date,
    fecha_terminacion date,
    fecha_liquidacion date,
    supervision_interventoria character varying,
    contratista_fk integer,
    objeto character varying
);
    DROP TABLE public.proyecto;
       public         heap    postgres    false            �            1259    20416    proyecto_certificado    TABLE     z   CREATE TABLE public.proyecto_certificado (
    id integer NOT NULL,
    certificado_id integer,
    proyedo_id integer
);
 (   DROP TABLE public.proyecto_certificado;
       public         heap    postgres    false            �            1259    20401    registro_presupuestal    TABLE     k   CREATE TABLE public.registro_presupuestal (
    id integer NOT NULL,
    numero integer,
    fecha date
);
 )   DROP TABLE public.registro_presupuestal;
       public         heap    postgres    false            #          0    20396    certificado_disponibilidad 
   TABLE DATA           a   COPY public.certificado_disponibilidad (id, rubro, valor, fuente_recursos, anticipo) FROM stdin;
    public          postgres    false    211   �8       %          0    20406    contratista 
   TABLE DATA           6   COPY public.contratista (id, nombre, nit) FROM stdin;
    public          postgres    false    213   �8       "          0    20386    contrato 
   TABLE DATA           �   COPY public.contrato (no_contrato, id, fecha_firma, f_aprob_polizas, valor_contrato, no_proyecto_fk, no_certificado, fecha_certificado, registro_id, no_presupuestal, fecha_presupuestal) FROM stdin;
    public          postgres    false    210   :       '          0    20456    coordenadas 
   TABLE DATA           �   COPY public.coordenadas (id, coo_proyecto_id, latitud, longitud, latitud_inicial, latitud_final, longitud_inicial, longitud_final) FROM stdin;
    public          postgres    false    215   :       (          0    20471    hitos 
   TABLE DATA           s   COPY public.hitos (id, hito, fecha_inicio, detalle_hito, valor_adiciones_hito, dias_hito, proyecto_id) FROM stdin;
    public          postgres    false    216   <:       )          0    20481    obras 
   TABLE DATA           d  COPY public.obras (id, sector, municipio_obra, departamento_obra, codigo_divipola_municipio, unidad_funcional_acuerdo_obra, fecha_inicial_terminacion, fecha_final_terminacion, avance_fisico_inicial, avance_fisico_ejecutado, avance_financiero_ejecutado, cantidad_suspensiones, cantidad_prorrogas, tiempo_suspensiones, tiempo_prorrogas, cantidad_adiciones, valor_total_adiciones, origen_recursos, valor_comprometido, valor_obligado, valor_pagado, valor_anticipo, latitud_inicial, latitud_final, longitud_final, estado, cesion, nuevo_contratista, observaciones, link_secop, proyecto_id, coordenadas_id) FROM stdin;
    public          postgres    false    217   Y:       !          0    20381    proyecto 
   TABLE DATA           �   COPY public.proyecto (id, no_proyecto, proceso, fecha_iniciacion, fecha_terminacion, fecha_liquidacion, supervision_interventoria, contratista_fk, objeto) FROM stdin;
    public          postgres    false    209   v:       &          0    20416    proyecto_certificado 
   TABLE DATA           N   COPY public.proyecto_certificado (id, certificado_id, proyedo_id) FROM stdin;
    public          postgres    false    214   !>       $          0    20401    registro_presupuestal 
   TABLE DATA           B   COPY public.registro_presupuestal (id, numero, fecha) FROM stdin;
    public          postgres    false    212   >>       �           2606    20400 :   certificado_disponibilidad certificado_disponibilidad_pkey 
   CONSTRAINT     x   ALTER TABLE ONLY public.certificado_disponibilidad
    ADD CONSTRAINT certificado_disponibilidad_pkey PRIMARY KEY (id);
 d   ALTER TABLE ONLY public.certificado_disponibilidad DROP CONSTRAINT certificado_disponibilidad_pkey;
       public            postgres    false    211            �           2606    20410    contratista contratista_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.contratista
    ADD CONSTRAINT contratista_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.contratista DROP CONSTRAINT contratista_pkey;
       public            postgres    false    213            ~           2606    20390    contrato contrato_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.contrato
    ADD CONSTRAINT contrato_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.contrato DROP CONSTRAINT contrato_pkey;
       public            postgres    false    210            �           2606    20460    coordenadas coordenadas_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.coordenadas
    ADD CONSTRAINT coordenadas_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.coordenadas DROP CONSTRAINT coordenadas_pkey;
       public            postgres    false    215            �           2606    20475    hitos hitos_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.hitos
    ADD CONSTRAINT hitos_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.hitos DROP CONSTRAINT hitos_pkey;
       public            postgres    false    216            �           2606    20485    obras obras_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.obras
    ADD CONSTRAINT obras_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.obras DROP CONSTRAINT obras_pkey;
       public            postgres    false    217            �           2606    20420 .   proyecto_certificado proyecto_certificado_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.proyecto_certificado
    ADD CONSTRAINT proyecto_certificado_pkey PRIMARY KEY (id);
 X   ALTER TABLE ONLY public.proyecto_certificado DROP CONSTRAINT proyecto_certificado_pkey;
       public            postgres    false    214            |           2606    20385    proyecto proyecto_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT proyecto_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.proyecto DROP CONSTRAINT proyecto_pkey;
       public            postgres    false    209            �           2606    20405 0   registro_presupuestal registro_presupuestal_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.registro_presupuestal
    ADD CONSTRAINT registro_presupuestal_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.registro_presupuestal DROP CONSTRAINT registro_presupuestal_pkey;
       public            postgres    false    212            �           2606    20421 #   proyecto_certificado certificado_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.proyecto_certificado
    ADD CONSTRAINT certificado_fk FOREIGN KEY (certificado_id) REFERENCES public.certificado_disponibilidad(id);
 M   ALTER TABLE ONLY public.proyecto_certificado DROP CONSTRAINT certificado_fk;
       public          postgres    false    214    211    3200            �           2606    20411    proyecto contatista_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT contatista_fk FOREIGN KEY (contratista_fk) REFERENCES public.contratista(id) NOT VALID;
 @   ALTER TABLE ONLY public.proyecto DROP CONSTRAINT contatista_fk;
       public          postgres    false    213    209    3204            �           2606    20461    coordenadas coo_proyecto_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.coordenadas
    ADD CONSTRAINT coo_proyecto_fk FOREIGN KEY (coo_proyecto_id) REFERENCES public.proyecto(id) NOT VALID;
 E   ALTER TABLE ONLY public.coordenadas DROP CONSTRAINT coo_proyecto_fk;
       public          postgres    false    3196    209    215            �           2606    20391    contrato no_proyecto_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.contrato
    ADD CONSTRAINT no_proyecto_fk FOREIGN KEY (no_proyecto_fk) REFERENCES public.proyecto(id) NOT VALID;
 A   ALTER TABLE ONLY public.contrato DROP CONSTRAINT no_proyecto_fk;
       public          postgres    false    209    3196    210            �           2606    20491    obras obra_coordenadas_id    FK CONSTRAINT     �   ALTER TABLE ONLY public.obras
    ADD CONSTRAINT obra_coordenadas_id FOREIGN KEY (coordenadas_id) REFERENCES public.coordenadas(id) NOT VALID;
 C   ALTER TABLE ONLY public.obras DROP CONSTRAINT obra_coordenadas_id;
       public          postgres    false    3208    217    215            �           2606    20486    obras obra_proyecto_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.obras
    ADD CONSTRAINT obra_proyecto_fk FOREIGN KEY (proyecto_id) REFERENCES public.proyecto(id) NOT VALID;
 @   ALTER TABLE ONLY public.obras DROP CONSTRAINT obra_proyecto_fk;
       public          postgres    false    209    3196    217            �           2606    20426     proyecto_certificado proyecto_id    FK CONSTRAINT     �   ALTER TABLE ONLY public.proyecto_certificado
    ADD CONSTRAINT proyecto_id FOREIGN KEY (proyedo_id) REFERENCES public.proyecto(id);
 J   ALTER TABLE ONLY public.proyecto_certificado DROP CONSTRAINT proyecto_id;
       public          postgres    false    3196    209    214            �           2606    20476    hitos proyectos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.hitos
    ADD CONSTRAINT proyectos_fk FOREIGN KEY (proyecto_id) REFERENCES public.proyecto(id) NOT VALID;
 <   ALTER TABLE ONLY public.hitos DROP CONSTRAINT proyectos_fk;
       public          postgres    false    3196    216    209            �           2606    20431 !   contrato registro_presupuestal_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.contrato
    ADD CONSTRAINT registro_presupuestal_fk FOREIGN KEY (registro_id) REFERENCES public.registro_presupuestal(id) NOT VALID;
 K   ALTER TABLE ONLY public.contrato DROP CONSTRAINT registro_presupuestal_fk;
       public          postgres    false    3202    212    210            #      x������ � �      %   "  x���j\AFk�a�~F#��I��2�M��w w��z�Y?�ԉ#��c��;�q��@;��F(p��zQm�ɬ�p?��X;0��6&�w�um�\2�6A������iO5���q�[�ĭ�IG���g�آk�Hƀ�ǜ���(<%-0�q]�,ʣ�!<�m�2�b�(�����D=Za/c���i�E���~���^s�E6x�e�T=��?lp��ۼAz$Yz'���˯%��.*�ߏu�Βn�D����^;C�B,��dG��[�6k(?��> �+{#���"~��^L      "      x������ � �      '      x������ � �      (      x������ � �      )      x������ � �      !   �  x�uT�n�6<������z�h�y`�E|ɥGj�0��Iy��O���{Ht�Z��Ů�*uW5JJU5���r�>�9
gK���RUY��r)K�o����R*��Y��K�v��p%p�)�5�D<������F���ۑP�3��IUk���ֲe\����2X��>�"�)���n�*�(�3��ӥo�;\&Pm.UY�Rjx8�gw֚Af&��t�k�h��ny�q�Ҳ���GT[�Z������;��5��_��r�x���5�P��;����|��XC.��})K�m��z�d�{�'��C����$|F,x�ah�Ju���-���>��p�@a#�� ԟ��P�o�a�`�x�/��KW�|EG�
�B��U��YGk&�Fai���i��\_h���}
��-�}7�!�+k��ǣIT��;�$�|�g��\!;�JV�z>����N#�<�Y	��ud��MD���Ɍi_�e�)�W�}�jf�,��Ga{��������D�]���,y��� W .��C^�-�%�x$z����>��l��t4<� �nT���=|�C��y�ѳqؓ+�f-�2��[KU�~���֘�o�+]	bk���x�j���{���Z��a۷5K}���Hϕ>vE���Ѱ�����Q���v'�¸��?Qv���4��{X�����gV��#[\0w�'�1�_����QJ*��g6˟�&��H������ws��/dirtE����E��j�w��f��y��[��;<Xr�9�9�X�DW����M��.g�z7��>��R�����lX�t(F�������?��$�$~����%�dh���VZ5}U���{z<�l�����K���O���g���#��7��+'���Q\��*"�,�����_���B���Rff���Gva�B
L{��_����>�      &      x������ � �      $      x������ � �     