openapi: 3.0.0
servers:
  - url: 'https://demo.<?php echo $domain;?>/index.php/api/v1'
  - url: '{protocol}://{domain}/index.php/api/v1'
    variables:
      domain:
        default: demo.<?php echo $domain;?>
		
      protocol:
        enum:
          - https
          - http
        default: https
  - url: 'http://localhost/phppos/PHP-Point-Of-Sale/index.php/api/v1'
info:
  description: >-
    <?php echo $name;?> API  You can find out more about <?php echo $short_name;?> at
    [https://<?php echo $domain;?>](https://<?php echo $domain;?>)
  version: "1.0"
  title: <?php echo $name;?> API
  termsOfService: 'https://<?php echo $domain;?>/terms_of_service.php'
  contact:
    name: <?php echo $short_name;?> Support
    url: https://support.<?php echo $domain;?>
	
    email: support@<?php echo $domain;?>
	
tags:
  - name: sales
  - name: registers
  - name: deliveries
  - name: receivings
  - name: customers
  - name: items
  - name: item kits
  - name: categories
  - name: attributes
  - name: tags
  - name: manufacturers
  - name: giftcards
  - name: suppliers
  - name: employees
  - name: locations
  - name: expenses
  - name: price_rules
  - name: appointment_types
  - name: appointments
  - name: modifiers  
  - name: invoices
  - name: invoice_payments  
  
paths:
  /registers:
    post:
      tags:
        - registers
      summary: Add a new register to the store
      operationId: addRegister
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewRegister'
        description: Register object that needs to be added to the POS
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Register'
            application/xml:
              schema:
                $ref: '#/components/schemas/Register'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - registers
      summary: Search/list registers
      operationId: searchRegisters
      parameters:
        - name: search
          in: query
          description: Search registers
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string
        - name: location_id
          in: query
          description: Search specific location
          required: false
          schema:
            type: string
        - name: offset
          in: query
          description: Offset to list registers
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of registers to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Registers'
            application/xml:
              schema:
                $ref: '#/components/schemas/Registers'
        '400':
          description: Invalid parameter(s)
  '/registers/{register_id}':
    post:
      tags:
        - registers
      summary: Update a register
      operationId: updateRegister
      parameters:
        - name: register_id
          in: path
          description: register id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated register
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/RegisterResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/RegisterResponse'
        '400':
          description: Invalid register ID supplied
        '404':
          description: Register not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewRegister'
        description: Register that needs to be added to the store
        required: true

    get:
      tags:
        - registers
      summary: Find register by register number or ID
      description: Returns a single register
      operationId: getRegisterByID
      parameters:
        - name: register_id
          in: path
          description: ID of register to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned register
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/RegisterResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/RegisterResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Register not found
    delete:
      tags:
        - registers
      summary: Deletes a register
      operationId: deleteRegister
      parameters:
        - name: register_id
          in: path
          description: ID of register to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted register
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/RegisterResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/RegisterResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Register not found
  '/registers/batch':
    post:
      tags: 
       - registers
      summary: Bulk create, update, and delete registers
      operationId: batchRegister
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkRegisters'
        description: Register objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkRegistersResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkRegistersResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /attributes:
    post:
      tags:
        - attributes
      summary: Add a new attribute to the store
      operationId: addAttribute
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewAttribute'
        description: Attribute object that needs to be added to the POS
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Attribute'
            application/xml:
              schema:
                $ref: '#/components/schemas/Attribute'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - attributes
      summary: Search/list attributes
      operationId: searchAttributes
      parameters:
        - name: search
          in: query
          description: Search attributes
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list attributes
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of attributes to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Attributes'
            application/xml:
              schema:
                $ref: '#/components/schemas/Attributes'
        '400':
          description: Invalid parameter(s)
  '/attributes/{attribute_id}':
    post:
      tags:
        - attributes
      summary: Update a attribute
      operationId: updateAttribute
      parameters:
        - name: attribute_id
          in: path
          description: attribute id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated attribute
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AttributeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AttributeResponse'
        '400':
          description: Invalid attribute ID supplied
        '404':
          description: Attribute not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewAttribute'
        description: Attribute that needs to be added to the store
        required: true

    get:
      tags:
        - attributes
      summary: Find attribute by attribute number or ID
      description: Returns a single attribute
      operationId: getAttributeByID
      parameters:
        - name: attribute_id
          in: path
          description: ID of attribute to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned attribute
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AttributeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AttributeResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Attribute not found
    delete:
      tags:
        - attributes
      summary: Deletes a attribute
      operationId: deleteAttribute
      parameters:
        - name: attribute_id
          in: path
          description: ID of attribute to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted attribute
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AttributeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AttributeResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Attribute not found
  '/attributes/batch':
    post:
      tags: 
       - attributes
      summary: Bulk create, update, and delete attributes
      operationId: batchAttribute
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkAttributes'
        description: Attribute objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkAttributesResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkAttributesResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /modifiers:
    post:
      tags:
        - modifiers
      summary: Add a new modifier to the store
      operationId: addModifier
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewModifier'
        description: Modifier object that needs to be added to the POS
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Modifier'
            application/xml:
              schema:
                $ref: '#/components/schemas/Modifier'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - modifiers
      summary: List modifiers
      operationId: searchModifiers
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Modifiers'
            application/xml:
              schema:
                $ref: '#/components/schemas/Modifiers'
        '400':
          description: Invalid parameter(s)
  '/modifiers/{modifier_id}':
    post:
      tags:
        - modifiers
      summary: Update a modifier
      operationId: updateModifier
      parameters:
        - name: modifier_id
          in: path
          description: modifier id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated modifier
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ModifierResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ModifierResponse'
        '400':
          description: Invalid modifier ID supplied
        '404':
          description: Modifier not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewModifier'
        description: Modifier that needs to be added to the store
        required: true

    get:
      tags:
        - modifiers
      summary: Find modifier by modifier number or ID
      description: Returns a single modifier
      operationId: getModifierByID
      parameters:
        - name: modifier_id
          in: path
          description: ID of modifier to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned modifier
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ModifierResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ModifierResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Modifier not found
    delete:
      tags:
        - modifiers
      summary: Deletes a modifier
      operationId: deleteModifier
      parameters:
        - name: modifier_id
          in: path
          description: ID of modifier to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted modifier
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ModifierResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ModifierResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Modifier not found
  '/modifiers/batch':
    post:
      tags: 
       - modifiers
      summary: Bulk create, update, and delete modifiers
      operationId: batchModifier
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkModifiers'
        description: Modifier objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkModifiersResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkModifiersResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
  /manufacturers:
    post:
      tags:
        - manufacturers
      summary: Add a new manufacturer to the store
      operationId: addManufacturer
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewManufacturer'
        description: Manufacturer object that needs to be added to the POS
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Manufacturer'
            application/xml:
              schema:
                $ref: '#/components/schemas/Manufacturer'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - manufacturers
      summary: Search/list manufacturers
      operationId: searchManufacturers
      parameters:
        - name: search
          in: query
          description: Search manufacturers
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list manufacturers
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of manufacturers to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Manufacturers'
            application/xml:
              schema:
                $ref: '#/components/schemas/Manufacturers'
        '400':
          description: Invalid parameter(s)
  '/manufacturers/{manufacturer_id}':
    post:
      tags:
        - manufacturers
      summary: Update a manufacturer
      operationId: updateManufacturer
      parameters:
        - name: manufacturer_id
          in: path
          description: manufacturer id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated manufacturer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ManufacturerResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ManufacturerResponse'
        '400':
          description: Invalid manufacturer ID supplied
        '404':
          description: Manufacturer not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewManufacturer'
        description: Manufacturer that needs to be added to the store
        required: true

    get:
      tags:
        - manufacturers
      summary: Find manufacturer by manufacturer number or ID
      description: Returns a single manufacturer
      operationId: getManufacturerByID
      parameters:
        - name: manufacturer_id
          in: path
          description: ID of manufacturer to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned manufacturer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ManufacturerResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ManufacturerResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Manufacturer not found
    delete:
      tags:
        - manufacturers
      summary: Deletes a manufacturer
      operationId: deleteManufacturer
      parameters:
        - name: manufacturer_id
          in: path
          description: ID of manufacturer to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted manufacturer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ManufacturerResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ManufacturerResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Manufacturer not found
  '/manufacturers/batch':
    post:
      tags: 
       - manufacturers
      summary: Bulk create, update, and delete manufacturers
      operationId: batchManufacturer
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkManufacturers'
        description: Manufacturer objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkManufacturersResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkManufacturersResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /tags:
    post:
      tags:
        - tags
      summary: Add a new tag to the store
      operationId: addTag
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewTag'
        description: Tag object that needs to be added to the POS
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Tag'
            application/xml:
              schema:
                $ref: '#/components/schemas/Tag'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - tags
      summary: Search/list tags
      operationId: searchTags
      parameters:
        - name: search
          in: query
          description: Search tags
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list tags
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of tags to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Tags'
            application/xml:
              schema:
                $ref: '#/components/schemas/Tags'
        '400':
          description: Invalid parameter(s)
  '/tags/{tag_id}':
    post:
      tags:
        - tags
      summary: Update a tag
      operationId: updateTag
      parameters:
        - name: tag_id
          in: path
          description: tag id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated tag
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/TagResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/TagResponse'
        '400':
          description: Invalid tag ID supplied
        '404':
          description: Tag not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewTag'
        description: Tag that needs to be added to the store
        required: true

    get:
      tags:
        - tags
      summary: Find tag by tag number or ID
      description: Returns a single tag
      operationId: getTagByID
      parameters:
        - name: tag_id
          in: path
          description: ID of tag to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned tag
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/TagResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/TagResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Tag not found
    delete:
      tags:
        - tags
      summary: Deletes a tag
      operationId: deleteTag
      parameters:
        - name: tag_id
          in: path
          description: ID of tag to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted tag
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/TagResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/TagResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Tag not found
  '/tags/batch':
    post:
      tags: 
       - tags
      summary: Bulk create, update, and delete tags
      operationId: batchTag
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkTags'
        description: Tag objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkTagsResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkTagsResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /appointment_types:
    post:
      tags:
        - appointment_types
      summary: Add a new appointment_type to the store
      operationId: addAppointmentType
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewAppointmentType'
        description: AppointmentType object that needs to be added to the POS
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentType'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentType'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - appointment_types
      summary: Search/list appointment_types
      operationId: searchAppointmentTypes
      parameters:
        - name: search
          in: query
          description: Search appointment_types
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list appointment_types
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of appointment_types to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentTypes'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentTypes'
        '400':
          description: Invalid parameter(s)
  '/appointment_types/{appointment_type_id}':
    post:
      tags:
        - appointment_types
      summary: Update a appointment_type
      operationId: updateAppointmentType
      parameters:
        - name: appointment_type_id
          in: path
          description: appointment_type id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated appointment_type
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentTypeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentTypeResponse'
        '400':
          description: Invalid appointment_type ID supplied
        '404':
          description: AppointmentType not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewAppointmentType'
        description: AppointmentType that needs to be added to the store
        required: true

    get:
      tags:
        - appointment_types
      summary: Find appointment_type by appointment_type number or ID
      description: Returns a single appointment_type
      operationId: getAppointmentTypeByID
      parameters:
        - name: appointment_type_id
          in: path
          description: ID of appointment_type to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned appointment_type
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentTypeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentTypeResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: AppointmentType not found
    delete:
      tags:
        - appointment_types
      summary: Deletes a appointment_type
      operationId: deleteAppointmentType
      parameters:
        - name: appointment_type_id
          in: path
          description: ID of appointment_type to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted appointment_type
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentTypeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentTypeResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: AppointmentType not found
  '/appointment_types/batch':
    post:
      tags: 
       - appointment_types
      summary: Bulk create, update, and delete appointment_types
      operationId: batchAppointmentType
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkAppointmentTypes'
        description: AppointmentType objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkAppointmentTypesResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkAppointmentTypesResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /categories:
    post:
      tags:
        - categories
      summary: Add a new category to the store
      operationId: addCategory
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewCategoryWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewCategoryWithImage'
        description: Item object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Category'
            application/xml:
              schema:
                $ref: '#/components/schemas/Category'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - categories
      summary: Search/list categories
      operationId: searchCategories
      parameters:
        - name: search
          in: query
          description: Search categories
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list categories
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of categories to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Categories'
            application/xml:
              schema:
                $ref: '#/components/schemas/Categories'
        '400':
          description: Invalid parameter(s)
  '/categories/{category_id}':
    post:
      tags:
        - categories
      summary: Update a category
      operationId: updateCategory
      parameters:
        - name: category_id
          in: path
          description: category_id to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated category
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/CategoryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/CategoryResponse'
        '400':
          description: Invalid category ID supplied
        '404':
          description: Category not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewCategoryWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewCategoryWithImage'
        description: Category that needs to be added to the store
        required: true

    get:
      tags:
        - categories
      summary: Find category by ID
      description: Returns a single category
      operationId: getCategoryByID
      parameters:
        - name: category_id
          in: path
          description: ID of category to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned category
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/CategoryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/CategoryResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Category not found
    delete:
      tags:
        - categories
      summary: Deletes a category
      operationId: deleteCategory
      parameters:
        - name: category_id
          in: path
          description: ID of category to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted category
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/CategoryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/CategoryResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Category not found
  '/categories/batch':
    post:
      tags: 
       - categories
      summary: Bulk create, update, and delete categories
      operationId: batchCategory
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkCategories'
        description: Category objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkCategoriesResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkCategoriesResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /price_rules:
    post:
      tags:
        - price_rules
      summary: Add a new price rule to the POS
      operationId: addPriceRule
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewPriceRule'
        description: Price rule object; not all fields are required depending on the type of price rule
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/PriceRule'
            application/xml:
              schema:
                $ref: '#/components/schemas/PriceRule'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - price_rules
      summary: Search/list price rules
      operationId: searchPriceRules
      parameters:
        - name: search
          in: query
          description: Search price rules
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list price rules
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of price rules to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/PriceRules'
            application/xml:
              schema:
                $ref: '#/components/schemas/PriceRules'
        '400':
          description: Invalid parameter(s)
  '/price_rules/{price_rule_id}':
    post:
      tags:
        - price_rules
      summary: Update a price rule
      operationId: updatePriceRule
      parameters:
        - name: price_rule_id
          in: path
          description: price rule id to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated price rule
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/PriceRuleResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/PriceRuleResponse'
        '400':
          description: Invalid price rule ID supplied
        '404':
          description: price rule not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewPriceRule'
        description: Price rule that needs to be added to the POS
        required: true

    get:
      tags:
        - price_rules
      summary: Find price rule by price rule ID
      description: Returns a single price rule
      operationId: getPriceRuleByID
      parameters:
        - name: price_rule_id
          in: path
          description: ID of price_rule to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned price rule
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/PriceRuleResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/PriceRuleResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Price rule not found
    delete:
      tags:
        - price_rules
      summary: Deletes a price _rule
      operationId: deletePriceRule
      parameters:
        - name: price_rule_id
          in: path
          description: ID of price rule to delete
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted price rule
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/PriceRuleResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/PriceRuleResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Price rule not found
  '/price_rules/batch':
    post:
      tags: 
       - price_rules
      summary: Bulk create, update, and delete price rules
      operationId: batchPriceRule
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkPriceRules'
        description: Price rule objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkPriceRulesResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkPriceRulesResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /appointments:
    post:
      tags:
        - appointments
      summary: Add a new appointment to the POS
      operationId: addAppointment
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewAppointment'
        description: appointments object; not all fields are required
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Appointment'
            application/xml:
              schema:
                $ref: '#/components/schemas/Appointment'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - appointments
      summary: Search/list appointments
      operationId: searchAppointments
      parameters:
        - name: search
          in: query
          description: Search appointments
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list appointments
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of appointments to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Appointments'
            application/xml:
              schema:
                $ref: '#/components/schemas/Appointments'
        '400':
          description: Invalid parameter(s)
  '/appointments/{appointment_id}':
    post:
      tags:
        - appointments
      summary: Update am appointment
      operationId: updateAppointment
      parameters:
        - name: appointment_id
          in: path
          description: appointment id to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated appointments
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentResponse'
        '400':
          description: Invalid appointment ID supplied
        '404':
          description: appointment not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewAppointment'
        description: appointments that needs to be added to the POS
        required: true

    get:
      tags:
        - appointments
      summary: Find appointment by appointment ID
      description: Returns a single appointment
      operationId: getAppointmentByID
      parameters:
        - name: appointment_id
          in: path
          description: ID of appointment to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned appointment
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: appointment not found
    delete:
      tags:
        - appointments
      summary: Deletes an appointment
      operationId: deleteAppointment
      parameters:
        - name: appointment_id
          in: path
          description: ID of appointment to delete
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted appointment
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/AppointmentResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/AppointmentResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: appointment not found
  '/appointments/batch':
    post:
      tags: 
       - appointments
      summary: Bulk create, update, and delete appointments
      operationId: batchAppointment
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkAppointments'
        description: appointments objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkAppointmentsResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkAppointmentsResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /expenses:
    post:
      tags:
        - expenses
      summary: Add a new expense to the store
      operationId: addExpense
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewExpense'
        description: Expense object that needs to be added to the POS
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Expense'
            application/xml:
              schema:
                $ref: '#/components/schemas/Expense'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - expenses
      summary: Search/list expenses
      operationId: searchExpenses
      parameters:
        - name: search
          in: query
          description: Search expenses
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string
						
        - name: location_id
          in: query
          description: Search specific location
          required: false
          schema:
            type: string
        - name: offset
          in: query
          description: Offset to list expenses
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of expenses to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Expenses'
            application/xml:
              schema:
                $ref: '#/components/schemas/Expenses'
        '400':
          description: Invalid parameter(s)
  '/expenses/{expense_id}':
    post:
      tags:
        - expenses
      summary: Update a expense
      operationId: updateExpense
      parameters:
        - name: expense_id
          in: path
          description: expense id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated expense
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseResponse'
        '400':
          description: Invalid expense ID supplied
        '404':
          description: Expense not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewExpense'
        description: Expense that needs to be added to the store
        required: true

    get:
      tags:
        - expenses
      summary: Find expense by expense number or ID
      description: Returns a single expense
      operationId: getExpenseByID
      parameters:
        - name: expense_id
          in: path
          description: ID of expense to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned expense
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Expense not found
    delete:
      tags:
        - expenses
      summary: Deletes a expense
      operationId: deleteExpense
      parameters:
        - name: expense_id
          in: path
          description: ID of expense to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted expense
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Expense not found
  '/expenses/batch':
    post:
      tags: 
       - expenses
      summary: Bulk create, update, and delete expenses
      operationId: batchExpense
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkExpenses'
        description: Expense objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkExpensesResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkExpensesResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /expenses_categories:
    post:
      tags:
        - expenses
      summary: Add a new category to the store
      operationId: addExpenseCategory
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewExpenseCategoryWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewExpenseCategoryWithImage'
        description: Item object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseCategory'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseCategory'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - expenses
      summary: Search/list categories
      operationId: searchExpenseCategories
      parameters:
        - name: search
          in: query
          description: Search categories
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list categories
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of categories to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseCategories'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseCategories'
        '400':
          description: Invalid parameter(s)
  '/expenses_categories/{category_id}':
    post:
      tags:
        - expenses
      summary: Update a category
      operationId: updateExpenseCategory
      parameters:
        - name: category_id
          in: path
          description: category_id to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated category
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseCategoryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseCategoryResponse'
        '400':
          description: Invalid category ID supplied
        '404':
          description: Category not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewExpenseCategoryWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewExpenseCategoryWithImage'
        description: Category that needs to be added to the store
        required: true

    get:
      tags:
        - expenses
      summary: Find category by ID
      description: Returns a single category
      operationId: getExpenseCategoryByID
      parameters:
        - name: category_id
          in: path
          description: ID of category to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned category
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseCategoryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseCategoryResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Category not found
    delete:
      tags:
        - expenses
      summary: Deletes a category
      operationId: deleteExpenseCategory
      parameters:
        - name: category_id
          in: path
          description: ID of category to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted category
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ExpenseCategoryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ExpenseCategoryResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Category not found
  '/expenses_categories/batch':
    post:
      tags: 
       - expenses
      summary: Bulk create, update, and delete categories
      operationId: batchExpenseCategory
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkExpenseCategories'
        description: Category objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkExpenseCategoriesResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkExpenseCategoriesResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
  
  /deliveries:
    get:
      tags:
        - deliveries
      summary: Search/list deliveries
      operationId: searchDeliveries
      parameters:
        - name: search
          in: query
          description: Search deliveries
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string
						
        - name: location_id
          in: query
          description: Search specific location
          required: false
          schema:
            type: string
        - name: offset
          in: query
          description: Offset to list deliveries
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of deliveries to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Deliveries'
            application/xml:
              schema:
                $ref: '#/components/schemas/Deliveries'
        '400':
          description: Invalid parameter(s)
  '/deliveries/{delivery_id}':
    post:
      tags:
        - deliveries
      summary: Update a delivery
      operationId: updateDelivery
      parameters:
        - name: delivery_id
          in: path
          description: delivery id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated delivery
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/DeliveryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/DeliveryResponse'
        '400':
          description: Invalid delivery id supplied
        '404':
          description: Delivery not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewDelivery'
        description: Delivery that needs to be added to the store
        required: true

    get:
      tags:
        - deliveries
      summary: Find delivery by delivery number or ID
      description: Returns a single delivery
      operationId: getDeliveryByID
      parameters:
        - name: delivery_id
          in: path
          description: ID of delivery to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned delivery
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/DeliveryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/DeliveryResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Delivery not found
    delete:
      tags:
        - deliveries
      summary: Deletes a delivery
      operationId: deleteDelivery
      parameters:
        - name: delivery_id
          in: path
          description: ID of delivery to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted delivery
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/DeliveryResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/DeliveryResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Delivery not found
  /receivings:
    get:
      tags:
        - receivings
      summary: Search/list receivings
      operationId: searchReceivings
      parameters:
        - name: start_date
          in: query
          description: Start date to search for receivings
          required: true
          schema:
            type: string
            format: date-time
            example: "2017-07-21T17:32:28Z"
        - name: end_date
          in: query
          description: End date to search for receivings
          required: true
          schema:
            type: string
            format: date-time
            example: "2017-07-21T17:32:28Z"
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Receivings'
            application/xml:
              schema:
                $ref: '#/components/schemas/Receivings'
        '400':
          description: Invalid parameter(s)
    post:
      tags:
        - receivings
      summary: Add a receiving to the POS
      operationId: addReceiving
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewReceiving'
        description: Receiving object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Receiving'
            application/xml:
              schema:
                $ref: '#/components/schemas/Receiving'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
  '/receivings/{receiving_id}':
    get:
      tags:
        - receivings
      summary: Get info about receiving
      operationId: getReceiving
      parameters:
        - name: receiving_id
          in: path
          description: ID of receiving to get
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Receiving'
            application/xml:
              schema:
                $ref: '#/components/schemas/Receiving'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
    post:
      tags:
        - receivings
      summary: Update a receiving in the POS
      operationId: updateReceiving
      parameters:
        - name: receiving_id
          in: path
          description: ID of receiving to update
          required: true
          schema:
            type: string
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewReceiving'
        description: Receiving object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Receiving'
            application/xml:
              schema:
                $ref: '#/components/schemas/Receiving'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'

    delete:
      tags:
       - receivings
      summary: Delete a receiving from POS
      operationId: deleteReceiving
      parameters:
        - name: receiving_id
          in: path
          description: ID of receiving to delete
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted receiving
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Receiving'
            application/xml:
              schema:
                $ref: '#/components/schemas/Receiving'
        '400':
          description: Invalid ID supplied
        '404':
          description: Receiving ID not found
      

  /sales:
    get:
      tags:
        - sales
      summary: Search/list sales
      operationId: searchSales
      parameters:
        - name: start_date
          in: query
          description: Start date to search for sales
          required: true
          schema:
            type: string
            format: date-time
            example: "2017-07-21T17:32:28Z"
        - name: end_date
          in: query
          description: End date to search for sales
          required: true
          schema:
            type: string
            format: date-time
            example: "2017-07-21T17:32:28Z"
        - name: customer_id
          in: query
          description: ID of customer to filter by
          required: false
          schema:
            type: number
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Sales'
            application/xml:
              schema:
                $ref: '#/components/schemas/Sales'
        '400':
          description: Invalid parameter(s)
    post:
      tags:
        - sales
      summary: Add a sale to the POS
      operationId: addSale
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewSale'
        description: Sale object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Sale'
            application/xml:
              schema:
                $ref: '#/components/schemas/Sale'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
  '/sales/{sale_id}':
    get:
      tags:
        - sales
      summary: Get info about sale
      operationId: getSale
      parameters:
        - name: sale_id
          in: path
          description: ID of sale to get
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Sale'
            application/xml:
              schema:
                $ref: '#/components/schemas/Sale'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'

    post:
      tags:
        - sales
      summary: Update a sale in the POS
      operationId: updateSale
      parameters:
        - name: sale_id
          in: path
          description: ID of sale to update
          required: true
          schema:
            type: string
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewSale'
        description: Sale object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Sale'
            application/xml:
              schema:
                $ref: '#/components/schemas/Sale'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'

    delete:
      tags:
       - sales
      summary: Delete a sale from POS
      operationId: deleteSale
      parameters:
        - name: sale_id
          in: path
          description: ID of sale to delete
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted sale
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Sale'
            application/xml:
              schema:
                $ref: '#/components/schemas/Sale'
        '400':
          description: Invalid ID supplied
        '404':
          description: Sale ID not found
      
  /giftcards:
    post:
      tags:
        - giftcards
      summary: Add a new giftcard to the store
      operationId: addGifcard
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewGiftcard'
        description: Gift Card object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Giftcard'
            application/xml:
              schema:
                $ref: '#/components/schemas/Giftcard'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    get:
      tags:
        - giftcards
      summary: Search/list gift cards
      operationId: searchGiftcards
      parameters:
        - name: search
          in: query
          description: Search gift cards
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list gift cards
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of gift cards to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Giftcards'
            application/xml:
              schema:
                $ref: '#/components/schemas/Giftcards'
        '400':
          description: Invalid parameter(s)
  '/giftcards/{giftcard_number}':
    post:
      tags:
        - giftcards
      summary: Update a gift card
      operationId: updateGiftcard
      parameters:
        - name: giftcard_number
          in: path
          description: giftcard id/number to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated gift card
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/GiftcardResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/GiftcardResponse'
        '400':
          description: Invalid item ID supplied
        '404':
          description: Gift Card not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewGiftcard'
        description: Gift card that needs to be added to the store
        required: true

    get:
      tags:
        - giftcards
      summary: Find gift card by giftcard number or ID
      description: Returns a single gift card
      operationId: getGiftcardByID
      parameters:
        - name: giftcard_number
          in: path
          description: ID of giftcard to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned gift card
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/GiftcardResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/GiftcardResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Giftcard not found
    delete:
      tags:
        - giftcards
      summary: Deletes a gift card
      operationId: deleteGiftcard
      parameters:
        - name: giftcard_number
          in: path
          description: ID of giftcard to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted gift card
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/GiftcardResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/GiftcardResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Giftcard not found
  '/giftcards/batch':
    post:
      tags: 
       - giftcards
      summary: Bulk create, update, and delete gift cards
      operationId: batchGiftcard
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkGiftcards'
        description: Giftcard objects that needs to be batched
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkGiftcardsResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkGiftcardsResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  /locations:
    get:
      tags:
        - locations
      summary: Search/list locations
      operationId: searchLocations
      parameters:
        - name: search
          in: query
          description: Search locations
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: search_field
          in: query
          description: Search specific field
          required: false
          schema:
            type: string
            enum:
              - location_id
              - name
              - address
        - name: offset
          in: query
          description: Offset to list locations
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of locations to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Locations'
            application/xml:
              schema:
                $ref: '#/components/schemas/Locations'
        '400':
          description: Invalid parameter(s)
  '/locations/{location_id}':
    get:
      tags:
        - locations
      summary: Find location by Location ID
      description: Returns a single location
      operationId: getLocationByLocationId
      parameters:
        - name: location_id
          in: path
          description: ID of location to return
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful updated location
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/LocationResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/LocationResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Location not found
  /item_kits:
    get:
      tags:
        - item kits
      summary: Search/list item kits
      operationId: searchItemKits
      parameters:
        - name: search
          in: query
          description: Search item kits
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string
        - name: category_id
          in: query
          description: Filter by category id
          required: false
          schema:
            type: string
        - name: search_field
          in: query
          description: Search specific field
          required: false
          schema:
            type: string
            enum:
              - item_kit_id
              - item_kit_number
              - product_id
              - name
              - description
              - cost_price
              - unit_price
              - manufacturer_name
              - tag_name
              - custom_field_1_value
              - custom_field_2_value
              - custom_field_3_value
              - custom_field_4_value
              - custom_field_5_value
              - custom_field_6_value
              - custom_field_7_value
              - custom_field_8_value
              - custom_field_9_value
              - custom_field_10_value
        - name: offset
          in: query
          description: Offset to list item kits
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of item kits to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemKits'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemKits'
        '400':
          description: Invalid parameter(s)
    post:
      tags:
        - item kits
      summary: Add a new item kit to the store
      operationId: addItemKit
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewItemKitWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewItemKitWithImage'
        description: Item Kit object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemKit'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemKit'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
  '/item_kits/{item_kit_id}':
    get:
      tags:
        - item kits
      summary: Find item kit by Item KIT ID
      description: Returns a single item kit
      operationId: getItemKitByItemKitId
      parameters:
        - name: item_kit_id
          in: path
          description: ID of item kit to return
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful updated item kit
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemKitResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemKitResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Item KIT not found
    post:
      tags:
        - item kits
      summary: Update an existing item kit
      operationId: updateItemKit
      parameters:
        - name: item_kit_id
          in: path
          description: Item kit id to update
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: Sucessfully updated item kit
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemKitResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemKitResponse'
        '400':
          description: Invalid item kit ID supplied
        '404':
          description: Item kit not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewItemKitWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewItemKitWithImage'
        description: Item Kit object that needs to be added to the store
        required: true
    delete:
      tags:
        - item kits
      summary: Deletes a item Kit
      operationId: deleteItemKit
      parameters:
        - name: item_kit_id
          in: path
          description: Item kit id to delete
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful deleted item kit
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemKitResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemKitResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Item Kit not found
  '/item_kits/batch':
    post:
      tags: 
       - item kits
      summary: Bulk create, update, and delete items
      operationId: batchItemKit
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkItemKits'
        description: Item kit object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkItemKitsResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkItemKitsResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
  /items:
    get:
      tags:
        - items
      summary: Search/list items
      operationId: searchItems
      parameters:
        - name: search
          in: query
          description: Search items
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: category_id
          in: query
          description: Filter by category id
          required: false
          schema:
            type: string
        - name: search_field
          in: query
          description: Search specific field
          required: false
          schema:
            type: string
            enum:
              - item_id
              - item_number
              - product_id
              - name
              - description
              - size
              - cost_price
              - unit_price
              - promo_price
              - reorder_level
              - supplier
              - manufacturer_name
              - tag_name
              - ecommerce_product_id
              - custom_field_1_value
              - custom_field_2_value
              - custom_field_3_value
              - custom_field_4_value
              - custom_field_5_value
              - custom_field_6_value
              - custom_field_7_value
              - custom_field_8_value
              - custom_field_9_value
              - custom_field_10_value
        - name: offset
          in: query
          description: Offset to list items
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of items to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Items'
            application/xml:
              schema:
                $ref: '#/components/schemas/Items'
        '400':
          description: Invalid parameter(s)
    post:
      tags:
        - items
      summary: Add a new item to the store
      operationId: addItem
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewItemWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewItemWithImage'
        description: Item object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Item'
            application/xml:
              schema:
                $ref: '#/components/schemas/Item'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
  '/items/{item_id}':
    get:
      tags:
        - items
      summary: Find item by Item ID
      description: Returns a single item
      operationId: getItemByItemId
      parameters:
        - name: item_id
          in: path
          description: ID of item to return
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful updated item
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Item not found
    post:
      tags:
        - items
      summary: Update an existing item
      operationId: updateItem
      parameters:
        - name: item_id
          in: path
          description: Item id to update
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: Sucessfully updated item
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemResponse'
        '400':
          description: Invalid item ID supplied
        '404':
          description: Item not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewItemWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewItemWithImage'
        description: Item object that needs to be added to the store
        required: true
    delete:
      tags:
        - items
      summary: Deletes an item
      operationId: deleteItem
      parameters:
        - name: item_id
          in: path
          description: Item id to delete
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful deleted item
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ItemResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ItemResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Item not found
  '/items/batch':
    post:
      tags: 
       - items
      summary: Bulk create, update, and delete items
      operationId: batchItem
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkItems'
        description: Item object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkItemsResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkItemsResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
  /employees:
    get:
      tags:
        - employees
      summary: Search/list employees
      operationId: searchEmployees
      parameters:
        - name: location_id
          in: query
          description: Location id to search in
          required: false
          schema:
            type: string
        - name: search
          in: query
          description: Search employees
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: search_field
          in: query
          description: Search specific field
          required: false
          schema:
            type: string
            enum:
              - first_name
              - last_name
              - email
              - username
              - phone_number
              - employee_number
              - custom_field_1_value
              - custom_field_2_value
              - custom_field_3_value
              - custom_field_4_value
              - custom_field_5_value
              - custom_field_6_value
              - custom_field_7_value
              - custom_field_8_value
              - custom_field_9_value
              - custom_field_10_value
        - name: offset
          in: query
          description: Offset to list employees
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of employees to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Employees'
            application/xml:
              schema:
                $ref: '#/components/schemas/Employees'
        '400':
          description: Invalid parameter(s)
    post:
      tags:
        - employees
      summary: Add a new employee to the store
      operationId: addEmployee
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewEmployeeWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewEmployeeWithImage'
        description: Employee object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Employee'
            application/xml:
              schema:
                $ref: '#/components/schemas/Employee'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
  '/employees/{person_id}':
    get:
      tags:
        - employees
      summary: Find person by Person ID
      description: Returns a single employee
      operationId: getEmployeeByPersonId
      parameters:
        - name: person_id
          in: path
          description: ID of employee to return
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful updated employee
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/EmployeeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/EmployeeResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Employee not found
    post:
      tags:
        - employees
      summary: Update an existing employee
      operationId: updateEmployee
      parameters:
        - name: person_id
          in: path
          description: Person id to update
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: Sucessfully updated employee
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/EmployeeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/EmployeeResponse'

        '400':
          description: Invalid person ID supplied
        '404':
          description: Employee not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewEmployeeWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewEmployeeWithImage'
        description: Employee object that needs to be added to the store
        required: true
    delete:
      tags:
        - employees
      summary: Deletes a employee
      operationId: deleteEmployee
      parameters:
        - name: person_id
          in: path
          description: Person id to delete
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful deleted employee
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/EmployeeResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/EmployeeResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Employee not found
  '/employees/batch':
    post:
      tags: 
       - employees
      summary: Bulk create, update, and delete employees
      operationId: batchEmployee
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkEmployees'
        description: Employee object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkEmployeesResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkEmployeesResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
  /suppliers:
    get:
      tags:
        - suppliers
      summary: Search/list suppliers
      operationId: searchSuppliers
      parameters:
        - name: search
          in: query
          description: Search suppliers
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: search_field
          in: query
          description: Search specific field
          required: false
          schema:
            type: string
            enum:
              - first_name
              - last_name
              - email
              - phone_number
              - company_name
              - account_number
              - custom_field_1_value
              - custom_field_2_value
              - custom_field_3_value
              - custom_field_4_value
              - custom_field_5_value
              - custom_field_6_value
              - custom_field_7_value
              - custom_field_8_value
              - custom_field_9_value
              - custom_field_10_value
        - name: offset
          in: query
          description: Offset to list suppliers
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of suppliers to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Suppliers'
            application/xml:
              schema:
                $ref: '#/components/schemas/Suppliers'
        '400':
          description: Invalid parameter(s)
    post:
      tags:
        - suppliers
      summary: Add a new supplier to the store
      operationId: addSupplier
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewSupplierWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewSupplierWithImage'

        description: Supplier object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Supplier'
            application/xml:
              schema:
                $ref: '#/components/schemas/Supplier'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
  '/suppliers/{person_id}':
    get:
      tags:
        - suppliers
      summary: Find person by Person ID
      description: Returns a single supplier
      operationId: getSupplierByPersonId
      parameters:
        - name: person_id
          in: path
          description: ID of supplier to return
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful updated supplier
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/SupplierResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/SupplierResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Supplier not found
    post:
      tags:
        - suppliers
      summary: Update an existing supplier
      operationId: updateSupplier
      parameters:
        - name: person_id
          in: path
          description: Person id to update
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: Sucessfully updated supplier
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/SupplierResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/SupplierResponse'
        '400':
          description: Invalid person ID supplied
        '404':
          description: Supplier not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewSupplierWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewSupplierWithImage'

        description: Supplier object that needs to be added to the store
        required: true
    delete:
      tags:
        - suppliers
      summary: Deletes a supplier
      operationId: deleteSupplier
      parameters:
        - name: person_id
          in: path
          description: Person id to delete
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful deleted supplier
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/SupplierResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/SupplierResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Supplier not found
  '/suppliers/batch':
    post:
      tags: 
       - suppliers
      summary: Bulk create, update, and delete suppliers
      operationId: batchSupplier
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkSuppliers'
        description: Supplier object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkSuppliersResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkSuppliersResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
  /customers:
    get:
      tags:
        - customers
      summary: Search/list customers
      operationId: searchCustomers
      parameters:
        - name: location_id
          in: query
          description: Location id to search in
          required: false
          schema:
            type: string
        - name: search
          in: query
          description: Search customers
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: search_field
          in: query
          description: Search specific field
          required: false
          schema:
            type: string
            enum:
              - first_name
              - last_name
              - email
              - phone_number
              - account_number
              - custom_field_1_value
              - custom_field_2_value
              - custom_field_3_value
              - custom_field_4_value
              - custom_field_5_value
              - custom_field_6_value
              - custom_field_7_value
              - custom_field_8_value
              - custom_field_9_value
              - custom_field_10_value
        - name: offset
          in: query
          description: Offset to list customers
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of customers to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Customers'
            application/xml:
              schema:
                $ref: '#/components/schemas/Customers'
        '400':
          description: Invalid parameter(s)
    post:
      tags:
        - customers
      summary: Add a new customer to the store
      operationId: addCustomer
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewCustomerWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewCustomerWithImage'
        description: Customer object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Customer'
            application/xml:
              schema:
                $ref: '#/components/schemas/Customer'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/ErrorResponse'
      
    
  '/customers/{person_id}':
    get:
      tags:
        - customers
      summary: Find person by Person ID
      description: Returns a single customer
      operationId: getCustomerByPersonId
      parameters:
        - name: person_id
          in: path
          description: ID of customer to return
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful updated customer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Customer'
            application/xml:
              schema:
                $ref: '#/components/schemas/Customer'
        '400':
          description: Invalid ID supplied
        '404':
          description: Customer not found
    post:
      tags:
        - customers
      summary: Update an existing customer
      operationId: updateCustomer
      parameters:
        - name: person_id
          in: path
          description: Person id to update
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: Sucessfully updated customer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/CustomerResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/CustomerResponse'
        '400':
          description: Invalid person ID supplied
        '404':
          description: Customer not found
        '405':
          description: Validation exception
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewCustomerWithImageUrl'
          multipart/form-data:
            schema:
              $ref: '#/components/schemas/NewCustomerWithImage'

        description: Customer object that needs to be added to the store
        required: true
    delete:
      tags:
        - customers
      summary: Deletes a customer
      operationId: deleteCustomer
      parameters:
        - name: person_id
          in: path
          description: Person id to delete
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: successful deleted customer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/CustomerResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/CustomerResponse'
        '400':
          description: Invalid ID supplied
        '404':
          description: Customer not found
  '/customers/batch':
    post:
      tags: 
       - customers
      summary: Bulk create, update, and delete customers
      operationId: batchCustomer
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/BulkCustomers'
        description: Customer object that needs to be added to the store
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BulkCustomersResponse'
            application/xml:
              schema:
                $ref: '#/components/schemas/BulkCustomersResponse'
        '405':
          description: Invalid input
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'
            application/xml:
              schema:
                $ref: '#/components/schemas/BasicErrorModel'

  '/invoices/customer':
    post:
      tags:
        - invoices
      summary: Add a new invoice to the POS
      operationId: addCustomerInvoice
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewInvoiceCustomer'
        description: invoices object; not all fields are required
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
        '400':
          description: Invalid Request
      
    get:
      tags:
        - invoices
      summary: Search/list invoices
      operationId: searchCustomerInvoices
      parameters:
        - name: search
          in: query
          description: Search invoice
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list invoice
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of invoice to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/CustomerInvoices'
            application/xml:
              schema:
                $ref: '#/components/schemas/CustomerInvoices'
        '404':
          description: Invoice not found
  '/invoices/customer/{invoice_id}':
    post:
      tags:
        - invoices
      summary: Update am invoice
      operationId: updateCustomerInvoice
      parameters:
        - name: invoice_id
          in: path
          description: invoice id to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated invoice
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
        '400':
          description: Bad request
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewInvoiceCustomer'
        description: invoice that needs to be added to the POS
        required: true

    get:
      tags:
        - invoices
      summary: Find invoice by invoice ID
      description: Returns a single invoice
      operationId: getCustomerInvoiceByID
      parameters:
        - name: invoice_id
          in: path
          description: ID of invoice to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned invoice
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
        '404':
          description: Invoice not found
    
    delete:
      tags:
        - invoices
      summary: Deletes an invoice
      operationId: deleteCustomerInvoice
      parameters:
        - name: invoice_id
          in: path
          description: ID of invoice to delete
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted invoice
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceCustomer'
        '404':
          description: Invoice not found
  
  '/invoices/supplier':
    post:
      tags:
        - invoices
      summary: Add a new invoice to the POS
      operationId: addSupplierInvoice
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewInvoiceSupplier'
        description: invoices object; not all fields are required
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
        '400':
          description: Invalid Request
      
    get:
      tags:
        - invoices
      summary: Search/list invoices
      operationId: searchSupplierInvoices
      parameters:
        - name: search
          in: query
          description: Search invoice
          required: false
          schema:
            type: string

        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string

        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string

        - name: offset
          in: query
          description: Offset to list invoice
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of invoice to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/SupplierInvoices'
            application/xml:
              schema:
                $ref: '#/components/schemas/SupplierInvoices'
        '404':
          description: Invoice not found
  '/invoices/supplier/{invoice_id}':
    post:
      tags:
        - invoices
      summary: Update am invoice
      operationId: updateSupplierInvoice
      parameters:
        - name: invoice_id
          in: path
          description: invoice id to update
          required: true
          schema:
            type: string
      responses:
        '200':
          description: Sucessfully updated 
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
        '400':
          description: Bad request
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewInvoiceSupplier'
        description: invoice that needs to be added to the POS
        required: true

    get:
      tags:
        - invoices
      summary: Find invoice by invoice ID
      description: Returns a single invoice
      operationId: getSupplierInvoiceByID
      parameters:
        - name: invoice_id
          in: path
          description: ID of invoice to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned invoice
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
        '404':
          description: Invoice not found
    
    delete:
      tags:
        - invoices
      summary: Deletes an invoice
      operationId: deleteSupplierInvoice
      parameters:
        - name: invoice_id
          in: path
          description: ID of invoice to delete
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful deleted invoice
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoiceSupplier'
        '404':
          description: Invoice not found

  '/invoices/payments/customer':
    post:
      tags:
        - invoice_payments
      summary: Add a new invoice payment to the POS
      operationId: addCustomerInvoicePayment
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewInvoicePayment'
        description: invoice payment object; not all fields are required
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
        '400':
          description: Bad Request
      
    get:
      tags:
        - invoice_payments
      summary: get list invoice payments
      operationId: getCustomerInvoicePayments
      parameters:
        - name: invoice_id
          in: query
          description: Search invoice payments
          required: false
          schema:
            type: string
        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string
        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string
        - name: offset
          in: query
          description: Offset to list invoice payments
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of invoice payments to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoicePayments'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoicePayments'
        '400':
          description: Invalid parameter(s)
  '/invoices/payments/customer/{payment_id}':
    get:
      tags:
        - invoice_payments
      summary: Find invoice payment by payment id
      description: Returns a single payment
      operationId: getCustomerInvoicePayment
      parameters:
        - name: payment_id
          in: path
          description: ID of payment to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned payments
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
        '404':
          description: payment not found

  '/invoices/payments/supplier':
    post:
      tags:
        - invoice_payments
      summary: Add a new invoice payment to the POS
      operationId: addSupplierInvoicePayment
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/NewInvoicePayment'
        description: invoice payment object; not all fields are required
        required: true
      responses:
        '200':
          description: successful operation
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
        '400':
          description: Bad Request
      
    get:
      tags:
        - invoice_payments
      summary: get list invoice payments
      operationId: getSupplierInvoicePayments
      parameters:
        - name: invoice_id
          in: query
          description: Search invoice payments
          required: false
          schema:
            type: string
        - name: sort_col
          in: query
          description: Sort Column
          required: false
          schema:
            type: string
        - name: sort_dir
          in: query
          description: Sort Direction
          required: false
          schema:
            type: string
        - name: offset
          in: query
          description: Offset to list invoice payments
          required: false
          schema:
            type: integer
            minimum: 0
            default: 0
        - name: limit
          in: query
          description: Number of invoice payments to get
          required: false
          schema:
            type: integer
            minimum: 1
            maximum: 100
            default: 20
      responses:
        '200':
          description: successful operation
          headers:
            x-total-records:
              description: Total number of results in search
              schema:
                type: integer
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoicePayments'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoicePayments'
        '400':
          description: Invalid parameter(s)
  '/invoices/payments/supplier/{payment_id}':
    get:
      tags:
        - invoice_payments
      summary: Find invoice payment by payment id
      description: Returns a single payment
      operationId: getSupplierInvoicePayment
      parameters:
        - name: payment_id
          in: path
          description: ID of payment to return
          required: true
          schema:
            type: string
      responses:
        '200':
          description: successful returned payments
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
            application/xml:
              schema:
                $ref: '#/components/schemas/InvoicePayment'
        '404':
          description: payment not found
                
security:
  - ApiKeyAuth: []
components:
  schemas:
    BasicErrorModel:
      type: object
      xml:
        name: xml
      required:
        - message
      properties:
        message:
          type: string
          example: "Bad request"
        code:
          type: integer
          minimum: 100
          maximum: 600
          example: 100
    BulkCustomers:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewCustomerWithImageUrl'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Customer'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkCustomersResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/CustomerResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/CustomerResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/CustomerResponse'
    Person:
      type: object
      xml:
        name: xml
      required:
        - first_name
      properties:
        first_name:
          type: string
          example: John
        last_name:
          type: string
          example: Doe
        email:
          type: string
          example: john@example.com
        phone_number:
          type: string
          example: 555-555-5555
        address_1:
          type: string
          example: 123 Nowhere Street
        address_2:
          type: string
          example: Apartment 123
        city:
          type: string
          example: Rochester
        state:
          type: string
          example: New York
        zip:
          type: string
          example: '14445'
        country:
          type: string
          example: United States
        comments:
          type: string
          example: A great customer
        custom_fields:
          type: object
          minProperties: 0
          maxProperties: 10
          additionalProperties:
            type: string
          example:
            secondary phone number: '555-555-5555'
    ExistingPerson:
      type: object
      xml:
        name: xml
      properties:
        person_id:
          type: integer
          format: uuid
          example: 3
    NewCustomer:
      type: object
      allOf:
        - $ref: '#/components/schemas/Person'
        - type: object
          properties:
            company_name:
              type: string
              example: PHP Point Of Sale
            tier_id:
              type: integer
              format: uuid
              example: 0
            account_number:
              type: string
              example: '3333'
            taxable:
              type: boolean
              example: false
            tax_certificate:
              type: string
              example: '1234'
            internal_notes:
              type: string
              example: 'A nice guy'
            override_default_tax:
              type: boolean
              example: false
            tax_class_id:
              type: integer
              format: uuid
              example: 0
            balance: 
              type: number
              format: float
              example: 22.99
            credit_limit:
              type: number  
              format: float
              example: 1000
            points:
              type: integer
              format: int32
              example: 333
            disable_loyalty:
              type: boolean 
              example: true
            amount_to_spend_for_next_point:
              type: number
              format: float
              readOnly: true
              example: 10.25
            remaining_sales_before_discount:
              type: integer
              format: int32
              readOnly: true
              example: 0
            location_id:
              type: integer
              format: int32
              example: 1
            customer_info_popup:
              type: string
              example: ""
            auto_email_receipt:
              type: boolean
              example: true
            always_sms_receipt:
              type: boolean
              example: true
            skip_webhook:
              type: boolean 
              example: true
            files:
              type: array 
              items:
                type: string
          xml:  
            name: xml
          
    NewCustomerWithImageUrl:
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/NewCustomer'
        - type: object
          properties:
            image_url:
              type: string
              example: http://www.abc.xyz
    NewCustomerWithImage:
      type: object
      xml:
        name: xml
      properties:
        customer:
          $ref: '#/components/schemas/NewCustomer'
        image:
          type: string
          format: binary
      required:
        - customer
        - image
    Customer:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingPerson'
        - $ref: '#/components/schemas/NewCustomerWithImageUrl'
    CustomerWithImage:
      type: object
      xml:
        name: xml
      properties:
        customer:
          $ref: '#/components/schemas/Customer'
        image:
          type: string
          format: binary
      required:
        - customer
        - image

    ErrorResponse:
      xml:
        name: xml
      properties:
        errors:
          type: array
          items:
            $ref: '#/components/schemas/BasicErrorModel'
    CustomerResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Customer'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Customers:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Customer'
    NewSupplier:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/Person'
        - type: object
          properties:
            company_name:
              type: string
              example: PHP Point Of Sale
            account_number:
              type: string
              example: '3333'
            override_default_tax:
              type: boolean
              example: false
            tax_class_id:
              type: integer
              format: int32
              example: 1
            balance: 
              type: number
              format: float
              example: 22.99
     
    NewSupplierWithImageUrl:
      xml:
        name: xml
      allOf:
      - $ref: '#/components/schemas/NewSupplier'
      - type: object
        properties:
          image_url:
            type: string
            example: http://www.abc.xyz
    
    NewSupplierWithImage:
      type: object
      xml:
        name: xml
      properties:
        supplier:
          $ref: '#/components/schemas/NewSupplier'
        image:
          type: string
          format: binary
      required:
        - customer
        - image
        
    Supplier:
      type: object
      allOf:
       - $ref: '#/components/schemas/ExistingPerson'
       - $ref: '#/components/schemas/NewSupplierWithImageUrl'
      xml:  
        name: xml
    
    SupplierWithImage:
      type: object
      xml:
        name: xml
      properties:
        supplier:
          $ref: '#/components/schemas/Supplier'
        image:
          type: string
          format: binary
      required:
        - supplier
        - image

    SupplierResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Supplier'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Suppliers:
      type: array
      items:
        $ref: '#/components/schemas/Supplier'
    BulkSuppliers:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewSupplierWithImageUrl'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Suppliers'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkSuppliersResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/SupplierResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/SupplierResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/SupplierResponse'
    
    NewEmployeeWithImage:
      type: object
      xml:
        name: xml
      properties:
        employee:
          $ref: '#/components/schemas/NewEmployee'
        image:
          type: string
          format: binary
      required:
        - employee
        - image

    NewEmployeeWithImageUrl:
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/NewEmployee'
        - type: object
          properties:
            image_url:
              type: string
              example: http://www.abc.xyz

    NewEmployee:
      required:
       - username
       - email
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/Person'
        - type: object
          properties:
            username:
              type: string
              example: admin
            password:
              type: string
              example: admin
            inactive:
              type: boolean
              example: false
            reason_inactive:
              type: string
              example: Quit
            hire_date:
              type: string
              format: date
              example: "2017-07-21"
            employee_number:
              type: string
              example: 3333
            birthday:
              type: string
              format: date
              example: "1980-07-21"
            login_start_time:
              type: string
              format: date
              example: "9:00 AM"
            login_end_time:
              type: string
              format: date
              example: "5:00 PM"
            termination_date:
              type: string
              format: date
              example: "2017-07-21"
            force_password_change:
              type: boolean
              example: false
            always_require_password:
              type: boolean
              example: false
            not_required_to_clock_in:
              type: boolean
              example: false
            commission_percent:
              type: number
              example: 10
            commission_percent_type:
              type: string
              example: selling_price
            hourly_pay_rate:
              type: number
              example: 150
            default_register_id:
              type: integer
              example: 1
            language:
              type: string
              example: english
            locations:
              type: array
              example: [1,2]
              items:
                type: integer
            permissions:
              $ref: '#/components/schemas/EmployeePermissions'
            permissions_location: 
              $ref: '#/components/schemas/ModuleActionLocation'
            dark_mode:
              type: boolean
              example: false
    Employee:
      type: object
      xml:
        name: xml
      allOf:
       - $ref: '#/components/schemas/ExistingPerson'
       - $ref: '#/components/schemas/NewEmployeeWithImageUrl'
    EmployeeResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Employee'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Employees:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Employee'
    BulkEmployees:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewEmployeeWithImageUrl'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Employee'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkEmployeesResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/EmployeeResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/EmployeeResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/EmployeeResponse'
    EmployeePermissions:
      type: object
      xml:
        name: xml
      additionalProperties:
        type: array
        items:
           type: string
    ImageUrl:
      type: object
      xml:
        name: xml
      properties:
        image_url:
          type: string
          example: http://www.abc.xyz
        title:
          type: string
          example: A nice image
        alt_text:
          type: string
          example: a nice alt text
        variation_id:
          type: integer
          example: 1
        main_image:
          type: boolean
          example: true

    ImageUrls:
      type: object
      xml:
        name: xml
      properties:
        images:
          type: array
          items:
            $ref: '#/components/schemas/ImageUrl'
    NewItem:
      type: object
      properties:
        name:
          type: string
          example: Penn Tennis Can
        barcode_name:
          type: string
          example: Penn Can
        modifiers:
          type: array
          example: [1,2,3]
          items:
            type: integer
        description:
          type: string
          example: 3 balls
        long_description:
          type: string
          example: 3 balls
        unit_price:
          type: number
          format: float
          example: 3.25
        cost_price:
          type: number
          format: float
          example: 1.25
        promo_price:
          type: number
          format: float
          example: 1.25
        start_date:
          type: string
          format: date
          example: "2018-01-01"
        end_date:
          type: string
          format: date
          example: "2018-01-01"
        change_cost_price:
          type: boolean
          example: false
        max_discount_percent:
          type: number
          format: float
          example: 3.25
        max_edit_price:
          type: number
          format: float
          example: 3.25
        min_edit_price:
          type: number
          format: float
          example: 3.25
        category_id:
          type: integer
          example: 2
        size:
          type: string
          example: small
        expire_days:
          type: integer
          example: 3
        supplier_id:
          type: integer
          example: 3
        manufacturer_id:
          type: integer
          example: 3
        item_number:
          type: string
          example: 072489010016
        product_id:
          type: string
          example: PEN-123
        ecommerce_product_id:
          type: string
          example: 15
        is_service:
          type: boolean
          example: false
        allow_price_override_regardless_of_permissions:
          type: boolean
          example: false
        only_integer:
          type: boolean
          example: false
        is_barcoded:
          type: boolean
          example: false
        item_inactive:
          type: boolean
          example: false
        allow_alt_description:
          type: boolean
          example: false
        is_serialized:
          type: boolean
          example: false
        is_favorite:
          type: boolean
          example: false
        override_default_tax:
          type: boolean
          example: false
        tax_class_id:
          type: integer
          example: 3
        main_image_id:
          type: integer
          example: 3
        is_ebt_item:
          type: boolean
          example: false
        is_ecommerce:
          type: boolean
          example: true
        disable_loyalty:
          type: boolean
          example: false
        commission_percent:
          type: number
          format: float
          example: 10
        commission_fixed:
          type: number
          format: float
          example: 2.55
        commission_percent_type:
          type: string
          example: selling_price
        tax_included:
          type: boolean
          example: false
        is_series_package:
          type: boolean
          example: false
        series_quantity:
          type: integer
          example: 3
        series_days_to_use_within:
          type: integer
          example: 3
        reorder_level:
          type: number
          format: float
          example: 5
        replenish_level:
          type: number
          format: float
          example: 5
        weight:
          type: number
          format: float
          example: 5
        length:
          type: number
          format: float
          example: 15
        width:
          type: number
          format: float
          example: 12
        height:
          type: number
          format: float
          example: 3
        additional_item_numbers:
          type: array
          example: ["122222","233233","323323"]
          items:
           type: string
        serial_numbers:
          type: array
          items:
            $ref: '#/components/schemas/ItemSerialNumber'
        tags:
          type: array
          example: ["Hot Seller","On Sale","Special Items"]
          items:
            type: string
        variations:
          type: array
          items:
            $ref: '#/components/schemas/ItemVariation'
        tier_pricing:
          type: array
          items:
            $ref: '#/components/schemas/TierPricing'
        default_quantity:
          type: number
          format: float
          example: 2
        info_popup:
          type: string
          example: Hello
        loyalty_multiplier:
          type: number
          format: float
          example: 2
        custom_fields:
          type: object
          minProperties: 0
          maxProperties: 10
          additionalProperties:
            type: string
          example:
            secondary phone number: '555-555-5555'
        locations:
            $ref: '#/components/schemas/ItemLocation'
        unit_variations:
          type: array
          items:
            $ref: '#/components/schemas/UnitVariation'
          
      xml:
        name: xml
    
    NewItemWithImageUrl:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/NewItem'
        - $ref: '#/components/schemas/ImageUrls'
    NewItemWithImage:
      type: object
      xml:
        name: xml
      properties:
        item:
          $ref: '#/components/schemas/NewItem'
        images[]:
          type: array
          items:
            type: string
            format: binary
        titles[]:
          type: array
          items:
            type: string
        alt_texts[]:
          type: array
          items:
            type: string
        variation_ids[]:
          type: array
          items:
            type: string
      required:
        - item

    ExistingItem:
      type: object
      xml:
        name: xml
      properties:
        item_id:
          type: integer
          format: uuid
          example: 3
          
    Item:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingItem'
        - $ref: '#/components/schemas/NewItemWithImageUrl'
    
    
    ExistingItemVariation:
      type: object
      xml:
        name: xml
      properties:
        variation_id:
          type: integer
          format: uuid
          example: 3

    NewItemVariation:
      type: object
      xml:
        name: xml
      properties:
        name:
          type: string
          example: "iPhone X 256GB Silver"
        item_number:
          type: string
          example: "3333"
        additional_item_numbers:
          type: array
          example: ["122222","233233","323323"]
          items:
           type: string
        unit_price:
          type: number
          example: 10.25
        cost_price:
          type: number
          example: 5.25
        promo_price:
          type: number
          format: float
          example: 1.25
        start_date:
          type: string
          format: date
          example: "2018-01-01"
        end_date:
          type: string
          format: date
          example: "2018-01-01"
        reorder_level:
          type: number
          format: float
          example: 5
        replenish_level:
          type: number
          format: float
          example: 5
        image_url:
          type: string
          example: http://www.abc.xyz
        image_title:
          type: string
          example: "Title"
        image_alt_text:
          type: string
          example: "Alt"
        attributes:
          type: array
          items:
            $ref: '#/components/schemas/NewItemVariationAttribute'

    ItemVariation:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingItemVariation'
        - $ref: '#/components/schemas/NewItemVariation'
          
    ExistingItemVariationAttribute:
      type: object
      xml:
        name: xml
      properties:
        item_id:
          type: integer
          format: uuid
          example: 3
          
    NewItemVariationAttribute:
      type: object
      xml:
        name: xml
      properties:
        name:
          type: string
          example: "Color"
        value:
          type: string
          example: "Silver"
    
    ItemVariationAttribute:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingItemVariationAttribute'
        - $ref: '#/components/schemas/NewItemVariationAttribute'

    ItemSerialNumber:
      type: object
      xml:
        name: xml
      properties:
        serial_number:
          type: string
          example: "3333"
        unit_price:
          type: number
          format: float
          example: 3.25
        cost_price:
          type: number
          format: float
          example: 2.25
        variation_id:
          type: integer
          example: 3
    ItemResponse:
       allOf:
        - $ref: '#/components/schemas/Item'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Items:
      type: array
      items:
        $ref: '#/components/schemas/Item'  
    BulkItems:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewItemWithImageUrl'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Item'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkItemsResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/ItemResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ItemResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/ItemResponse'

    NewItemKitWithImageUrl:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/NewItemKit'
        - $ref: '#/components/schemas/ImageUrls'
    NewItemKitWithImage:
      type: object
      xml:
        name: xml
      properties:
        item_kit:
          $ref: '#/components/schemas/NewItemKit'
        images[]:
          type: array
          items:
            type: string
            format: binary
        titles[]:
          type: array
          items:
            type: string
        alt_texts[]:
          type: array
          items:
            type: string
      required:
        - item_kit

    NewItemKit:
      type: object
      properties:
        name:
          type: string
          example: 3 Penn Tennis Cans Pack
        barcode_name:
          type: string
          example: 3 Penn Cans
        modifiers:
          type: array
          example: [1,2,3]
          items:
            type: integer
        dynamic_pricing:
          type: boolean
          example: false
        unit_price:
          type: number
          format: float
          example: 3.25
        cost_price:
          type: number
          format: float
          example: 1.25
        is_favorite:
          type: boolean
          example: false
        max_discount_percent:
          type: number
          format: float
          example: 3.25
        max_edit_price:
          type: number
          format: float
          example: 3.25
        min_edit_price:
          type: number
          format: float
          example: 3.25
        description:
          type: string
          example: 3 balls
        info_popup:
          type: string
          example: Hello
        allow_price_override_regardless_of_permissions:
          type: boolean
          example: false
        only_integer:
          type: boolean
          example: false
        is_barcoded:
          type: boolean
          example: false
        item_kit_inactive:
          type: boolean
          example: false
        category_id:
          type: integer
          example: 2
        manufacturer_id:
          type: integer
          example: 3
        item_kit_number:
          type: string
          example: 072489010016
        product_id:
          type: string
          example: PENPACK-123
        override_default_tax:
          type: boolean
          example: false
        tax_class_id:
          type: integer
          example: 3
        is_ebt_item:
          type: boolean
          example: false
        disable_loyalty:
          type: boolean
          example: false
        change_cost_price:
          type: boolean
          example: false
        commission_percent:
          type: number
          format: float
          example: 10
        commission_fixed:
          type: number
          format: float
          example: 2.55
        commission_percent_type:
          type: string
          example: selling_price
        tax_included:
          type: boolean
          example: false
        default_quantity:
          type: number
          format: float
          example: 2
        loyalty_multiplier:
          type: number
          format: float
          example: 2
        tags:
          type: array
          example: ["Hot Seller","On Sale","Special Item Kits"]
          items:
            type: string
        items: 
          type: array
          items:
            $ref: '#/components/schemas/ItemKitItem'
        item_kits: 
          type: array
          items:
            $ref: '#/components/schemas/ItemKitItemKit'
        tier_pricing:
          type: array
          items:
            $ref: '#/components/schemas/TierPricing'
        custom_fields:
          type: object
          minProperties: 0
          maxProperties: 10
          additionalProperties:
            type: string
          example:
            secondary phone number: '555-555-5555'
        locations:
            $ref: '#/components/schemas/ItemKitLocation'
      xml:
        name: xml
        
    ItemKitItem:
      type: object
      xml:
        name: xml
      properties:
        item_id:
          type: integer
          example: 2
        quantity:
          type: integer
          example: 3
          
    ItemKitItemKit:
      type: object
      xml:
        name: xml
      properties:
        item_kit_item_kit:
          type: integer
          example: 2
        quantity:
          type: integer
          example: 3
    ExistingItemKit:
      type: object
      xml:
        name: xml
      properties:
        item_kit_id:
          type: integer
          format: uuid
          example: 3
          
    ItemKit:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingItemKit'
        - $ref: '#/components/schemas/NewItemKit'
        
    ItemKitResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/ItemKit'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    ItemKits:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/ItemKit'  
    BulkItemKits:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewItemKit'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ItemKit'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkItemKitsResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/ItemKitResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ItemKitResponse'
        delete:
          type: array
          xml:
            name: xml
          items:
            $ref: '#/components/schemas/ItemKitResponse'
    NewLocation:
      type: object
      properties:
        name:
          type: string
          example: East Rochester
        address:
          type: string
          example: "123 Nowhere street"
        color:
          type: string
          example: "#ff0000"
        company:
          type: string
          example: PHP POS
        website:
          type: string
          example: "https://<?php echo $domain;?>"
        phone:
          type: string
          example: 555-555-5555
        fax:
          type: string
          example: 555-555-5555
        email:
          type: string
          example: "chris@example.com"
        cc_email:
          type: string
          example: "chris@example.com"
        bcc_email:
          type: string
          example: "chris@example.com"
        return_policy:
          type: string
          example: "No returns allowed"
        receive_stock_alert:
          type: boolean
          example: false
        stock_alert_email:
          type: string
          example: "chris@example.com"
        timezone:
          type: string
          example: "America/New_York"
        mailchimp_api_key:
          type: string
          example: "ad81adf0a104924b45b05aab2325c9b410-us2"
        platformly_api_key:
          type: string
          example: "qH6mRbS9icYzCR4F7xayI9qdrkEIvzIg"
        platformly_project_id:
          type: number
          example: 1234
        enable_credit_card_processing:
          type: boolean
          example: false
        credit_card_processor:
          type: string
          example: 'mercury'
        stripe_public:
          type: string
          example: 'XXXX'
        stripe_private:
          type: string
          example: 'XXXX'
        braintree_merchant_id:
          type: string
          example: 'XXXX'
        braintree_public_key:
          type: string
          example: 'XXXX'
        braintree_private_key:
          type: string
          example: 'XXXX'
        stripe_currency_code:
          type: string
          example: 'USD'
        hosted_checkout_merchant_id:
          type: string
          example: 'XXXX'
        hosted_checkout_merchant_password:
          type: string
          example: 'XXXX'
        emv_merchant_id:
          type: string
          example: 'XXXX'
        net_e_pay_server:
          type: string
          example: '127.0.0.1'
        com_port:
          type: string
          example: '9'
        listener_port:
          type: string
          example: '3333'
        secure_device_override_emv:
          type: string
          example: 'XXXX'
        secure_device_override_non_emv:
          type: string
          example: 'XXXX'
        ebt_integrated:
          type: boolean
          example: true
        integrated_gift_cards:
          type: boolean
          example: true
        tax_class_id:
          type: number
          format: integer
          example: 2
        default_tax_1_rate:
          type: number
          format: float
          example: 8.000
        default_tax_1_name:
          type: string
          example: 'Sales Tax 1'
        default_tax_2_rate:
          type: number
          format: float
          example: 8.000
        default_tax_2_name:
          type: string
          example: 'Sales Tax 2'
        default_tax_2_cumulative:
          type: boolean
          example: false
        default_tax_3_rate:
          type: number
          format: float
          example: 8.000
        default_tax_3_name:
          type: string
          example: 'Sales Tax 3'
        default_tax_4_rate:
          type: number
          format: float
          example: 8.000
        default_tax_4_name:
          type: string
          example: 'Sales Tax 4'
        default_tax_5_rate:
          type: number
          format: float
          example: 8.000
        default_tax_5_name:
          type: string
          example: 'Sales Tax 5'
        company_logo_url:
          type: string
          format: binary
        registers:
          type: array
          items:
            $ref: '#/components/schemas/Register'
      xml:
        name: xml
    NewRegister:
      type: object
      properties:
        name:
          type: string
          example: Register 1
        iptran_device_id:
          type: string
          example: "12344443"
        emv_terminal_id:
          type: string
          example: '123'
        location_id:
         type: number
         format: integer
         example: 1
      xml:
        name: xml
    
    ExistingRegister:
      type: object
      xml:
        name: xml
      properties:
        register_id:
          type: integer
          format: uuid
          example: 3
          
    Register:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingRegister'
        - $ref: '#/components/schemas/NewRegister'
        
    ExistingLocation:
      type: object
      xml:
        name: xml
      properties:
        location_id:
          type: integer
          format: uuid
          example: 3
          
    Location:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingLocation'
        - $ref: '#/components/schemas/NewLocation'
        
    LocationResponse:
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/Location'
      anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Locations:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Location'  
    TierPricing:
      type: object
      xml:
        name: xml
      properties:
        name:
          type: string
          example: "Wholesale"
        value:
          type: number
          format: float
          example: 2.25
        type:
          type: string
          example: "unit_price"
          enum:
            - unit_price
            - percent_off
            - cost_plus_percent
            - cost_plus_fixed_amount
    ItemLocation:
      type: object
      xml:
        name: xml
      additionalProperties:
         type: object
         properties:
           quantity:
             type: number
             format: float
             example: 1
           location:
             type: string
             example: "Behind counter"
           unit_price:
            type: number
            format: float
            example: 3.25
           cost_price:
             type: number
             format: float
             example: 1.25
           promo_price:
             type: number
             format: float
             example: 1.25
           start_date:
             type: string
             format: date
             example: "2018-01-01"
           end_date:
             type: string
             format: date
             example: "2018-01-01"
           reorder_level:
             type: number
             format: float
             example: 5
           replenish_level:
             type: number
             format: float
             example: 5
           override_default_tax:
             type: boolean
             example: false
           tax_class_id:
             type: integer
             format: uuid
             example: 0
           tier_pricing:
             type: array
             items:
               $ref: '#/components/schemas/TierPricing'
           variations:
             type: array
             xml:
               name: xml
             items:
               properties:
                variation_id:
                  type: number
                  format: integer
                  example: 5
                reorder_level:
                  type: number
                  format: float
                  example: 5
                cost_price:
                  type: number
                  format: float
                  example: 5
                unit_price:
                  type: number
                  format: float
                  example: 5
                replenish_level:
                  type: number
                  format: float
                  example: 5
                quantity:
                  type: number
                  format: float
                  example: 5
    ItemKitLocation:
      type: object
      xml:
        name: xml
      additionalProperties:
         type: object
         properties:
           unit_price:
            type: number
            format: float
            example: 3.25
           cost_price:
             type: number
             format: float
             example: 1.25
           override_default_tax:
             type: boolean
             example: false
           tax_class_id:
             type: integer
             format: uuid
             example: 0
           tier_pricing:
             type: array
             items:
               $ref: '#/components/schemas/TierPricing'


    NewGiftcard:
      type: object
      properties:
        giftcard_number:
          type: string
          example: "1232342323"
        description:
          type: string
          example: "Gift card provided after a return"
        value:
          type: number
          format: float
        customer_id:
          type: number
          format: float
          example: 10      
        inactive:
          type: boolean
          example: false          
      xml:
        name: xml        

    ExistingGiftcard:
      type: object
      xml:
        name: xml
      properties:
        giftcard_id:
          type: integer
          format: uuid
          example: 3
          
    Giftcard:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingGiftcard'
        - $ref: '#/components/schemas/NewGiftcard'
        
    GiftcardResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Giftcard'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Giftcards:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Giftcard'  
    BulkGiftcards:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewGiftcard'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Giftcard'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkGiftcardsResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/GiftcardResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/GiftcardResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/GiftcardResponse'

    ExistingSale:
      type: object
      xml:
        name: xml
      properties:
        sale_id:
          type: integer
          format: uuid
          example: 3
        receipt_url:
          type: string
          example: "https://demo.phppointofsale.com/index.php/r/Ad82"
        rule_id:
          type: integer
          format: int32
          example: 1
        store_account_payment:
          type: boolean
          example: true
        sale_time:
          type: string
          format: date-time
          example: "2017-07-21T17:32:28Z"        
        subtotal:
          type: number
          format: float
          example: 20
        tax:
          type: number
          format: float
          example: 2.45
        total:
          type: number
          format: number
          example: 22.45
        profit:
          type: number
          format: number
          example: 22.45
        tip:
          type: number
          format: number
          example: 2.00
        deleted:
          type: boolean
          example: true
        customer_first_name:
          type: string
          example: "John"
        customer_last_name:
          type: string
          example: "Doe"
        customer_email:
          type: string
          example: "hello@example.com"
        customer_phone_number:
          type: string
          example: "555-555-5555"
        customer_address_1:
          type: string
          example: "123 Nowhere street"
        customer_address_2:
          type: string
          example: "Apt 4"
        customer_city:
          type: string
          example: "Rochester"
        customer_state:
          type: string
          example: "NY"
        customer_zip:
          type: string
          example: "14450"
        customer_country:
          type: string
          example: "USA"
        customer_comments:
          type: string
          example: "awesome"
        customer_internal_notes:
          type: string
          example: "Pays on time"
        customer_company_name:
          type: string
          example: "Acme"
        customer_tier_id:
          type: integer
          example: 2
        customer_account_number:
          type: string
          example: "333333"
        customer_taxable:
          type: boolean
          example: true
        customer_tax_certificate:
          type: string
          example: "12345"
        customer_override_default_tax:
          type: boolean
          example: true
        customer_tax_class_id:
          type: integer
          example: 2
        customer_balance:
          type: number
          format: float
          example: 3
        customer_credit_limit:
          type: number
          format: float
          example: 300
        customer_disable_loyalty:
          type: boolean
          example: true
        customer_points:
          type: integer
          example: 2
        customer_image_url:
          type: string
          example: "https://example.com/image/jpg"
        customer_created_at:
          type: string
          format: date-time
        customer_location_id:
          type: integer
          example: 2
    Sale:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingSale'
        - $ref: '#/components/schemas/NewSale'

    Sales:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Sale'
    NewSale:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/CartSale'
        - $ref: '#/components/schemas/Cart'
   
    CartPayment:
      type: object
      xml:
        name: xml
      properties:
        payment_type:
          type: string
          example: "Cash"
        payment_amount:
         type: number
         format: float
         example: 3.00
        payment_date:
          type: string
          format: date-time
          example: "2017-07-21T17:32:28Z"
    Cart:
      type: object
      xml:
        name: xml
      properties:
        location_id:
          type: integer
          example: 1
        location_name:
          type: string
          example: "Default"
        employee_id:
          type: integer
          example: 1
        register_id:
          type: integer 
          example: 1
        excluded_taxes:
          type: array
          example: ['8.000% Sales Tax']
          items:
            type: string
        comment: 
          type: string
          example: "comment here"
        paid_store_account_ids:
          type: array
          example: 
          items:
            type: integer
        skip_webhook:
          type: boolean
          example: true
        change_cart_date:
          type: string
          format: date-time
          example: "2017-07-21T17:32:28Z"
        suspended:
          type: integer
          example: 0
        custom_fields:
          type: object
          minProperties: 0
          maxProperties: 10
          additionalProperties:
            type: string
          example:
            secondary phone number: '555-555-5555'
        payments:
          type: array
          items:
            $ref: '#/components/schemas/CartPayment'
    CartSale:
      type: object
      xml:
        name: xml
      properties:
        mode: 
          type: string
          example: "sale"
        customer_id:
          type: integer
          example: 2
        show_comment_on_receipt:
          type: boolean
          example: true
        selected_tier_id:
          type: integer
          example: 2
        sold_by_employee_id:
         type: integer
         example: 1
        points_used:
          type: integer
          format: int32
          example: 1
        points_gained:
          type: integer
          format: int32
          example: 2
        discount_reason:
         type: string
         example: "Loyal customer"
        has_delivery:
          type: boolean
          example: true
        email_receipt:
          type: boolean
          example: true
        delivery:
           type: object
           allOf:
           - $ref: '#/components/schemas/Delivery'
        cart_items:
          type: array
          items:
            anyOf:
            - $ref: '#/components/schemas/SaleCartItem'
            - $ref: '#/components/schemas/SaleCartItemKit'
        return_sale_id:
          type: integer
          example: ""
    ExistingDelivery:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          format: uuid
          example: 3
        sale_id:
          type: integer
          format: uuid
          example: 3
    NewDelivery:
      type: object
      xml:
        name: xml
      properties:
         delivery_person_info:
           type: object
           allOf:
            - $ref: '#/components/schemas/Person'
         delivery_info:
           type: object
           allOf:
            - $ref: '#/components/schemas/DeliveryInfo'
         delivery_tax_group_id: 
           type: integer
           example: 1

    Delivery:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingDelivery'
        - $ref: '#/components/schemas/NewDelivery'
    DeliveryInfo:
     type: object
     xml:
       name: xml
     properties:
       status:
          type: string
          enum:
           - completed
           - not_scheduled
           - scheduled
           - shipped
           - delivered
       is_pickup:
         type: boolean
         example: true
       comment:
         type: string
         example: "Needs to be fast"
       shipping_method_id:
         type: integer
         example: 1
       shipping_zone_id:
         type: integer
         example: 1
       tracking_number:
         type: string
         example: "12345"
       estimated_shipping_date:
        type: string
        format: date-time
       estimated_delivery_or_pickup_date:
        type: string
        format: date-time
       actual_delivery_or_pickup_date:
        type: string
        format: date-time
       actual_shipping_date:
        type: string
        format: date-time
       delivery_employee_person_id:
        type: integer
        example: 1
       location_id:
        type: integer
        example: 2
       duration:
        type: integer
        example: 30
    DeliveryResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Delivery'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Deliveries:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Delivery'  
    CartItemBase:
      type: object
      xml: 
        name: xml
      properties:
        quantity:
          type: number
          format: float
          example: 4
        unit_price:
          type: number
          format: float
          example: 4.25
        discount:
          type: number
          format: float
          example: 10
        name:
          type: string
          example: Penn Tennis Can        
        item_number:
          type: string
          example: 072489010016
        product_id:
          type: string
          example: PEN-123
        description:
          type: string
          example: "Great Item"
        serialnumber:
          type: string
          example: "1234393849384"
        size:
          type: string
          example: "large"
    CartItem:
      type: object
      xml:
        name: xml
      properties:
        item_id:
          type: integer
          example: 4
        variation_id:
          type: integer
          example: 4
    CartItemKit:
      type: object
      xml:
        name: xml
      properties:
        item_kit_id:
          type: integer
          example: 4
    SaleCartItem: 
      type: object
      xml:
        name: xml
      properties:
        damaged_qty: 
          type: number
          example: 8
        cost_price:
          type: number
          format: float
          example: 4.25
        tier_id:
          type: integer
          format: uuid
          example: 0
        override_tax_names:
          type: array
          example: ['Federal Tax','State Tax']
          items:
            type: string
        override_tax_percents:
          type: array
          example: [6.00,2.00]
          items:
            type: number
            format: float
        override_tax_cumulatives:
          type: array
          example: [0,1]
          items:
            type: number
            format: integer
        modifier_items: 
         type: array
         items:
           $ref: '#/components/schemas/ModifierItem'
      allOf:
        - $ref: '#/components/schemas/CartItemBase'
        - $ref: '#/components/schemas/CartItem'

    SaleCartItemKit: 
      type: object
      xml:
        name: xml
      properties:
        cost_price:
          type: number
          format: float
          example: 4.25
        tier_id:
          type: integer
          format: uuid
          example: 0
        modifier_items: 
           type: array
           items:
             $ref: '#/components/schemas/ModifierItem'
      allOf:
        - $ref: '#/components/schemas/CartItemBase'
        - $ref: '#/components/schemas/CartItemKit'
    RecvCartItem: 
      type: object
      xml:
        name: xml
      properties:
        quantity_received:
          type: number
          format: float
          example: 3
        selling_price:
          type: number
          format: float
          example: 2.35
        expire_date:
          type: string
          format: date
          example: "2018-12-31"
      allOf:
        - $ref: '#/components/schemas/CartItemBase'
        - $ref: '#/components/schemas/CartItem'
    CartReceiving:
      type: object
      properties:
        mode: 
          type: string
          example: "receive"
        shipping_cost: 
          type: number
          example: 8.00
        supplier_id:
          type: integer
          example: 2
        transfer_location_id:
          type: integer
          example: 2
        is_po:
          type: boolean
          example: true
        cart_items:
          type: array
          items:
            anyOf:
            - $ref: '#/components/schemas/RecvCartItem'
     
    ExistingReceiving:
      type: object
      xml:
        name: xml
      properties:
        receiving_id:
          type: integer
          format: uuid
          example: 3
        receiving_time:
          type: string
          format: date-time
          example: "2017-07-21T17:32:28Z"        
        subtotal:
          type: number
          format: float
          example: 20
        tax:
          type: number
          format: float
          example: 2.45
        total:
          type: number
          format: number
          example: 22.45
        deleted:
          type: boolean
          example: true


        supplier_first_name:
          type: string
          example: "John"
        supplier_last_name:
          type: string
          example: "Doe"
        supplier_email:
          type: string
          example: "hello@example.com"
        supplier_phone_number:
          type: string
          example: "555-555-5555"
        supplier_address_1:
          type: string
          example: "123 Nowhere street"
        supplier_address_2:
          type: string
          example: "Apt 4"
        supplier_city:
          type: string
          example: "Rochester"
        supplier_state:
          type: string
          example: "NY"
        supplier_zip:
          type: string
          example: "14450"
        supplier_country:
          type: string
          example: "USA"
        supplier_comments:
          type: string
          example: "awesome"
        supplier_company_name:
          type: string
          example: "Acme"
        supplier_account_number:
          type: string
          example: "333333"
        supplier_balance:
          type: number
          format: float
          example: 3
        supplier_override_default_tax:
          type: boolean
          example: true
        supplier_tax_class_id:
          type: integer
          example: 2
        supplier_image_url:
          type: string
          example: "https://example.com/image/jpg"
        supplier_created_at:
          type: string
          format: date-time
    Receiving:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingReceiving'
        - $ref: '#/components/schemas/NewReceiving'
    Receivings:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Receiving'
    NewReceiving:
      type: object
      allOf:
        - $ref: '#/components/schemas/CartReceiving'
        - $ref: '#/components/schemas/Cart'
    
    NewExpense:
      type: object
      properties:
         location_id:
           type: integer
           example: 1
         category_id:
           type: integer
           example: 1
         expense_type:
            type: string
            example: "Utilities"
         expense_description:
            type: string
            example: "Utilities"
         expense_reason:
            type: string
            example: "Utilities"
         expense_date:
            type: string
            format: date-time
         expense_amount:
            type: number
            format: float
            example: 20.55
         expense_tax:
            type: number
            format: float
            example: 20.55
         expense_note:
            type: string
            example: "Utilities"
         employee_id:
            type: integer
            example: 1
         approved_employee_id:
            type: integer
            example: 1
         expense_payment_type:
            type: string
            example: "Cash"
      xml:
        name: xml        

    ExistingExpense:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
          
    Expense:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingExpense'
        - $ref: '#/components/schemas/NewExpense'
        
    ExpenseResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Expense'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Expenses:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Expense'  
    BulkExpenses:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewExpense'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Expense'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkExpensesResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/ExpenseResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ExpenseResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/ExpenseResponse'
    NewPriceRule:
      type: object
      properties:
         name:
           type: string
           example: "Bogo for tennis cans"
         type:
           type: string
           enum:
             - spend_x_get_discount
             - simple_discount
             - advanced_discount
             - buy_x_get_y_free
             - buy_x_get_discount
         start_date:
           type: string
           format: date
           example: "2018-01-01"
         end_date:
           type: string
           format: date
           example: "2018-01-30"
         active:
           type: boolean
           example: true
         items_to_buy: 
            type: integer
            example: 1
         items_to_get:
           type: integer
           example: 1
         percent_off:
           type: number
           format: float
         fixed_off:
           type: number
           format: float
         spend_amount:
           type: number
           format: float
         num_times_to_apply:
           type: integer
           example: 1
         coupon_code:
           type: string
           example: "12345"
         description:
           type: string
           example: "price rule description"
         coupon_spend_amount:
           type: number
           format: float
           example: 100
         show_on_receipt:
           type: boolean
           example: true
         item_ids:
           type: array
           example: [1,2,3]
           items:
             type: integer
         item_kit_ids:
           type: array
           example: [1,2,3]
           items:
             type: integer
         tags:
           type: array
           example: ['small','hot seller']
           items:
             type: string
         category_ids:
           type: array
           example: [1,2,3]
           items:
             type: integer
         manufacturer_ids:
           type: array
           example: [1,2,3]
           items:
             type: integer
         price_breaks:
           type: array
           items:
             $ref: '#/components/schemas/PriceRulePriceBreak'  
         location_ids:
           type: array
           example: [1,2,3]
           items:
             type: integer
      xml:
        name: xml        

    ExistingPriceRule:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
    PriceRulePriceBreak:
      type: object
      xml:
        name: xml
      properties:
        item_qty_to_buy:
          type: integer
          example: 3
        discount_per_unit_fixed:
          type: number
          format: float
          example: 3.00
        discount_per_unit_percent:
          type: number
          format: float
          example: 10
    PriceRule:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingPriceRule'
        - $ref: '#/components/schemas/NewPriceRule'
        
    PriceRuleResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/PriceRule'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    PriceRules:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/PriceRule'  
    BulkPriceRules:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewPriceRule'
        update:
          type: array
          items:
            $ref: '#/components/schemas/PriceRule'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkPriceRulesResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/PriceRuleResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/PriceRuleResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/PriceRuleResponse'
    
    NewCategory:
      type: object
      properties:
         name:
            type: string
            example: "Shoes"
         color:
            type: string
            example: "#ff0000"
         category_info_popup:
            type: string
            example: "Hello"
         hide_from_grid:
            type: boolean
            example: false
         parent_id:
            type: integer
            example: 2
      xml:
        name: xml        
    NewCategoryWithImageUrl:
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/NewCategory'
        - type: object
          properties:
            image_url:
              type: string
              example: http://www.abc.xyz
    NewCategoryWithImage:
      type: object
      xml:
        name: xml
      properties:
        category:
          $ref: '#/components/schemas/NewCategory'
        image:
          type: string
          format: binary
      required:
        - category
        - image
    Category:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingCategory'
        - $ref: '#/components/schemas/NewCategoryWithImageUrl'
    CategoryWithImage:
      type: object
      xml:
        name: xml
      properties:
        category:
          $ref: '#/components/schemas/Category'
        image:
          type: string
          format: binary
      required:
        - category
        - image

    ExistingCategory:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
        
    CategoryResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Category'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Categories:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Category'  
    BulkCategories:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewCategoryWithImageUrl'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Category'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkCategoriesResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/CategoryResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/CategoryResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/CategoryResponse'

    NewExpenseCategory:
      type: object
      properties:
         name:
            type: string
            example: "Utilities"
         parent_id:
            type: integer
            example: 2
      xml:
        name: xml        
    NewExpenseCategoryWithImageUrl:
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/NewExpenseCategory'
    NewExpenseCategoryWithImage:
      type: object
      xml:
        name: xml
      properties:
        category:
          $ref: '#/components/schemas/NewExpenseCategory'
      required:
        - category
    ExpenseCategory:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingExpenseCategory'
        - $ref: '#/components/schemas/NewExpenseCategoryWithImageUrl'
    ExpenseCategoryWithImage:
      type: object
      xml:
        name: xml
      properties:
        category:
          $ref: '#/components/schemas/ExpenseCategory'
        image:
          type: string
          format: binary
      required:
        - category
        - image

    ExistingExpenseCategory:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
        
    ExpenseCategoryResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/ExpenseCategory'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    ExpenseCategories:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/ExpenseCategory'  
    BulkExpenseCategories:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewExpenseCategoryWithImageUrl'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ExpenseCategory'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkExpenseCategoriesResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/ExpenseCategoryResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ExpenseCategoryResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/ExpenseCategoryResponse'

    NewTag:
      type: object
      properties:
         name:
           type: string
           example: "Popular Items"
      xml:
        name: xml        

    ExistingTag:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
          
    Tag:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingTag'
        - $ref: '#/components/schemas/NewTag'
        
    TagResponse:
      xml:
        name: xml
      allOf:
       - $ref: '#/components/schemas/Tag'
      anyOf:
       - $ref: '#/components/schemas/ErrorResponse'
    Tags:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Tag'  
    BulkTags:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewTag'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Tag'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkTagsResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/TagResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/TagResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/TagResponse'

    NewManufacturer:
      type: object
      properties:
         name:
           type: string
           example: "Apple"
      xml:
        name: xml        

    ExistingManufacturer:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
          
    Manufacturer:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingManufacturer'
        - $ref: '#/components/schemas/NewManufacturer'
        
    ManufacturerResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Manufacturer'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Manufacturers:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Manufacturer'  
    BulkManufacturers:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewManufacturer'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Manufacturer'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkManufacturersResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/ManufacturerResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ManufacturerResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/ManufacturerResponse'
    NewAttribute:
      type: object
      xml:
        name: xml
      properties:
         name:
           type: string
           example: "Color"
         values:
           type: array
           example: ["Red","Yellow","Blue"]
           items:
             type: string
    ExistingAttribute:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 2
    Attribute:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingAttribute'
        - $ref: '#/components/schemas/NewAttribute'
        
    AttributeResponse:
       xml:
        name: xml
       allOf:
        - $ref: '#/components/schemas/Attribute'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Attributes:
      xml:
        name: xml
      type: array
      items:
        $ref: '#/components/schemas/Attribute'  
    BulkAttributes:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewAttribute'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Attribute'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkAttributesResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/AttributeResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/AttributeResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/AttributeResponse'

    NewModifier:
      type: object
      xml:
        name: xml
      properties:
         name:
           type: string
           example: "Pizza Toppings"
         items: 
           type: array
           items:
             $ref: '#/components/schemas/ModifierItem'


    ExistingModifier:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 2
    Modifier:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingModifier'
        - $ref: '#/components/schemas/NewModifier'
        
    ModifierResponse:
       xml:
        name: xml
       allOf:
        - $ref: '#/components/schemas/Modifier'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Modifiers:
      xml:
        name: xml
      type: array
      items:
        $ref: '#/components/schemas/Modifier'  
    BulkModifiers:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewModifier'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Modifier'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkModifiersResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/ModifierResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/ModifierResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/ModifierResponse'

    ModifierItem:
      type: object
      xml:
        name: xml
      properties:
         id:
           type: integer
           example: 2
         name:
           type: string
           example: "Pepperoni"
         unit_price:
          type: number
          format: float
          example: 3.25
         cost_price:
          type: number
          format: float
          example: 1.25

    ModifierItemResponse:
       xml:
        name: xml
       allOf:
        - $ref: '#/components/schemas/ModifierItem'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    ModifierItems:
      xml:
        name: xml
      type: array
      items:
        $ref: '#/components/schemas/ModifierItem'

    RegisterResponse:
       xml:
        name: xml
       allOf:
        - $ref: '#/components/schemas/Register'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Registers:
      type: array
      items:
        $ref: '#/components/schemas/Register'  
      xml:
        name: xml
    BulkRegisters:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewRegister'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Register'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkRegistersResponse:
      type: object
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/RegisterResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/RegisterResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/RegisterResponse'
      xml:
        name: xml
    NewAppointment:
      allOf:
      - type: object
        properties:
           location_id:
             type: integer
             example: 1
           customer_id:
             type: integer
             example: 2
           employee_id:
             type: integer
             example: 1
           start_time:
            type: string
            format: date-time
            example: "2017-07-21T17:32:28Z"        
           end_time:
            type: string
            format: date-time
            example: "2017-07-21T17:32:28Z"        
           appointments_type_id:
             type: integer
             example: 1
           notes:
            type: string
            example: "An example note"        
      - $ref: '#/components/schemas/Customer'
      xml:
        name: xml        

    ExistingAppointment:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
        employee_first_name:
          type: string
          example: "John"
        employee_last_name:
          type: string
          example: "Doe"
        employee_email:
          type: string
          example: "hello@example.com"
        employee_phone_number:
          type: string
          example: "555-555-5555"
        employee_address_1:
          type: string
          example: "123 Nowhere street"
        employee_address_2:
          type: string
          example: "Apt 4"
        employee_city:
          type: string
          example: "Rochester"
        employee_state:
          type: string
          example: "NY"
        employee_zip:
          type: string
          example: "14450"
        employee_country:
          type: string
          example: "USA"
        customer_first_name:
          type: string
          example: "John"
        customer_last_name:
          type: string
          example: "Doe"
        customer_email:
          type: string
          example: "hello@example.com"
        customer_phone_number:
          type: string
          example: "555-555-5555"
        customer_address_1:
          type: string
          example: "123 Nowhere street"
        customer_address_2:
          type: string
          example: "Apt 4"
        customer_city:
          type: string
          example: "Rochester"
        customer_state:
          type: string
          example: "NY"
        customer_zip:
          type: string
          example: "14450"
        customer_country:
          type: string
          example: "USA"
        customer_comments:
          type: string
          example: "awesome"
        customer_internal_notes:
          type: string
          example: "Pays on time"
        customer_company_name:
          type: string
          example: "Acme"
        customer_tier_id:
          type: integer
          example: 2
        customer_account_number:
          type: string
          example: "333333"
        customer_taxable:
          type: boolean
          example: true
        customer_tax_certificate:
          type: string
          example: "12345"
        customer_override_default_tax:
          type: boolean
          example: true
        customer_tax_class_id:
          type: integer
          example: 2
        customer_balance:
          type: number
          format: float
          example: 3
        customer_credit_limit:
          type: number
          format: float
          example: 300
        customer_disable_loyalty:
          type: boolean
          example: true
        customer_points:
          type: integer
          example: 2
        customer_image_url:
          type: string
          example: "https://example.com/image/jpg"
        customer_created_at:
          type: string
          format: date-time
        customer_location_id:
          type: integer
          example: 2

    Appointment:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingAppointment'
        - $ref: '#/components/schemas/NewAppointment'
        
    AppointmentResponse:
       xml:
         name: xml
       allOf:
        - $ref: '#/components/schemas/Appointment'
       anyOf:
        - $ref: '#/components/schemas/ErrorResponse'
    Appointments:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/Appointment'  
    BulkAppointments:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewAppointment'
        update:
          type: array
          items:
            $ref: '#/components/schemas/Appointment'
        delete:
          type: array
          example: [1,2,3]
          items:
            type: integer
    BulkAppointmentsResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/AppointmentResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/AppointmentResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/AppointmentResponse'

    NewAppointmentType:
      type: object
      properties:
         name:
           type: string
           example: "Haircut"
      xml:
        name: xml        

    ExistingAppointmentType:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          example: 1
          
    AppointmentType:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingAppointmentType'
        - $ref: '#/components/schemas/NewAppointmentType'
        
    AppointmentTypeResponse:
      xml:
        name: xml
      allOf:
       - $ref: '#/components/schemas/AppointmentType'
      anyOf:
       - $ref: '#/components/schemas/ErrorResponse'
    AppointmentTypes:
      type: array
      xml:
        name: xml
      items:
        $ref: '#/components/schemas/AppointmentType'  
    BulkAppointmentTypes:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/NewAppointmentType'
        update:
          type: array
          items:
            $ref: '#/components/schemas/AppointmentType'
        delete:
          type: array
          example: [1,2,3]
          items: 
            type: integer
    BulkAppointmentTypesResponse:
      type: object
      xml:
        name: xml
      properties:
        create: 
          type: array
          items:
            $ref: '#/components/schemas/AppointmentTypeResponse'
        update:
          type: array
          items:
            $ref: '#/components/schemas/AppointmentTypeResponse'
        delete:
          type: array
          items:
            $ref: '#/components/schemas/AppointmentTypeResponse'
    LocationExample:
      type: array
      example: [1,2,3]
      items:
        type: integer
    LocationPermissions:
      type: object
      xml:
        name: xml
      properties:
        locations:
          type: array
          items:
            $ref: '#/components/schemas/LocationExample'
        action:
          type: object
          xml:
            name: xml
          additionalProperties:
            type: object
            properties:
              locations:
                type: array
                xml:
                  name: xml
                items:
                  $ref: '#/components/schemas/LocationExample'
    ModuleActionLocation:
      type: object
      xml:
        name: xml
      additionalProperties:
        type: object
        xml:
          name: xml
        $ref: '#/components/schemas/LocationPermissions'
    UnitVariation:
      type: object
      xml:
        name: xml
      allOf:
        - $ref: '#/components/schemas/ExistingItemUnitVariation'
        - $ref: '#/components/schemas/NewUnitVariation'

    ExistingItemUnitVariation:
      type: object
      xml:
        name: xml
      properties:
        id:
          type: integer
          format: uuid
          example: 3
    NewUnitVariation:
      type: object
      xml:
        name: xml
      properties:
        item_id:
          type: number
          example: 2
        unit_name:
          type: string
          example: "Dozen"
        unit_quantity:
          type: number
          example: 2.25
        unit_price:
          type: number
          format: float
          example: 2.25
        cost_price:
          type: number
          format: float
          example: 2.25
        quantity_unit_item_number:
          type: string
          example: ""
  securitySchemes:
    ApiKeyAuth: 
      type: apiKey
      in: header
      name: x-api-key